<?php

namespace App\Livewire;
use App\Models\Post;
use Livewire\WithPagination;
use Livewire\Component;

class ListPosts extends Component
{
    use WithPagination;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.list-posts', ['posts' => Post::where('title', 'like', '%' . $this->search .'%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(5),
            ])->extends('layouts.app');
    }
}