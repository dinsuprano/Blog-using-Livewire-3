<?php

namespace App\Livewire;

use Livewire\Component;

class PostNotFound extends Component
{
    public function render()
    {
        return view('livewire.post-not-found')->extends('layouts.app');
    }
}
