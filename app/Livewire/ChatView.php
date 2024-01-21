<?php

namespace App\Livewire;

use Livewire\Component;

class ChatView extends Component
{
    public function render()
    {
        return view('livewire.pages.chat-view')->extends('livewire.pages.chat-view');
    }
}
