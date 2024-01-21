<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('livewire.pages.login')->extends('livewire.pages.login');
    }
}
