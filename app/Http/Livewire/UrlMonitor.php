<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Url;
use App\Jobs\CheckUrl;

class UrlMonitor extends Component
{
    public $urlSite;

    public $arrUrl;

    protected $listeners = ['urlUpdated' => 'render'];

    protected $rules   = [
        'urlSite' => 'required|url|max:250'
    ];

    protected $messages   = [
        'required' => 'Informe a URL',
        'url' => 'Informe uma URL válida',
        'max' => 'A URL deve ter no máximo 250 caracteres'
    ];

    /**
     * Salva a url a ser monitorada no banco de dados
     */
    public function create()
    {
        // --- valida url ---
        $this->validate();

        // --- salva url ---
        $url = Url::create([
            'url' => $this->urlSite, 
            'monitorar' => 1,
            'check_time' => '5']);

        // --- limpa campo ---
        $this->urlSite  = null;

        if ($url)
        {
            CheckUrl::dispatch($url->id);
            session()->flash('message', 'URL adicionada ao monitoramento');
        }
    }

    /**
     * Altera o status do monitoramento da url
     */
    public function alterarStatusMonitoramento($idUrl, $status)
    {
        // --- novo status de monitoramento ---
        $novoStatus = $status == 1 ? 0 : 1;

        // --- atualiza a url ---
        $url            = Url::find($idUrl);
        if ($url)
        {
            $url->monitorar = $novoStatus;
            $url->save();
             
            if ($novoStatus == 1)
                CheckUrl::dispatch($url->id)->delay(now()->addMinutes($url->check_time));
        }
    }

     /**
     * Altera o periodo de monitoramento da url
     */
    public function alterarPeriodoMonitoramento($idUrl, $periodo)
    {
        // --- novo periodo de monitoramento --- 
        $novoPeriodo = (int)$periodo;

        if ($novoPeriodo == 1 || $novoPeriodo == 5 || $novoPeriodo == 10)
        {
            // --- atualiza a url ---
            $url                = Url::find($idUrl);
            if ($url)
            {
                $url->check_time    = (string)$novoPeriodo;
                $url->save();

                if ($url->monitorar == 1)
                    CheckUrl::dispatch($url->id)->delay(now()->addMinutes($url->check_time));
            }
        }
    }

    /**
     * exclui a url do monitoramento
     */
    public function excluirUrl($idUrl)
    {
        $url    = Url::find($idUrl);
        if ($url)
        {
            $link   = $url->url;
            $result = $url->delete();

            if ($result)
                session()->flash('message', $link . ' excluída do monitoramento');
        }
    }

    public function openModal($urlId)
    {
        $this->emit('modalOpened', $urlId);
    }

    public function render()
    {
        // --- lista url cadastradas ---
        $this->arrUrl =  Url::all();

        return view('livewire.url-monitor', [$this->arrUrl]);
    }
}
