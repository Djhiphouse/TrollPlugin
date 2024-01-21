<?php

namespace App\Livewire;

use Livewire\Component;

class Server extends Component
{
    public function render()
    {
        return view('livewire.pages.server')->extends('livewire.pages.server');
    }
}
