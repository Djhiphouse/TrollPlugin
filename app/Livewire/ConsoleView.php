<?php

namespace App\Livewire;

use App\Models\Console;
use Livewire\Component;

class ConsoleView extends Component
{
    public $logs = [];
    public $server_id;

    public function mount()
    {
        // You can initialize logs here if needed
    }

    public function render()
    {
        return view('livewire.pages.console-view')->extends('livewire.pages.console-view');
    }

    public  function getLogs()
    {
        // Replace this with your logic to fetch logs

    }
}
