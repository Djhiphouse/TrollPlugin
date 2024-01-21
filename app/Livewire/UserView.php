<?php

namespace App\Livewire;

use Livewire\Component;

class UserView extends Component
{
    public function render()
    {
        return view('livewire.pages.user-view')->extends('livewire.pages.user-view');
    }
}
