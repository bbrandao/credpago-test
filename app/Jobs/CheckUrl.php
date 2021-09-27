<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Url;
use App\Models\UrlLog;

class CheckUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urlId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($urlId)
    {
        $this->urlId  = $urlId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // --- init ---
        $url        = Url::find($this->urlId);

        if ($url)
        {
            $urlLookup  = $url->url;
        
            // --- verifica se o monitoramento esta ativado ---
            if ($url->monitorar == 1)
            {
                // --- google page speed online api ---
                $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=" . $urlLookup . "&key=" . env('GOOGLE_PAGESPEEDONLINE_KEY');
                
                // --- curl config for screenshot ---
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiUrl);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($curl);
                curl_close($curl);

                // --- decode response ---
                $googleData     = json_decode($response, true);

                // --- url screenshot ---
                $snapDetails    = $googleData["lighthouseResult"]["audits"]["full-page-screenshot"]["details"];
                $snapImage      = $snapDetails["screenshot"];

                // --- curl config status ---
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $urlLookup);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $response   = curl_exec($curl);
                $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                // --- salva infos ---
                UrlLog::create([
                    'url_id' => $url->id,
                    'status_code' => (string)$statusCode,
                    'data'  => $snapImage['data']
                ]);

                // --- cria outro job ---
                self::dispatch($url->id)->delay(now()->addMinutes($url->check_time));
            }
        }
    }
}
