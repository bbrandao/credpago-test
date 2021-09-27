<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Url;

class LogUrl extends Component
{
    public $urlSite;

    public $arrLogs;

    public $display;

    protected $listeners = ['modalOpened' => 'updateModal'];

    public function updateModal($urlId)
    {
        $url    = Url::find($urlId);
        if ($url)
        {
            $this->urlSite = $url->url;
            $this->arrLogs = $url->logs;
            $this->display = "block";
        }
    }

    public function closeModal()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->urlSite  = "";
        $this->display  = "none";
        $this->arrLogs  = array();
    }
    
    public function render()
    {
        return view('livewire.log-url');
    }
}
