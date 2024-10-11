<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ListPosts extends Component
{
    public function render()
    {
        return view('livewire.list-posts', [
        'posts' => Post::orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
