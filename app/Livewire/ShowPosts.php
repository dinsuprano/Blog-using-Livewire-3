<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowPosts extends Component
{
    public $posts;

    public function loadPosts()
    {
        $this->posts = Post::all(); //fetch all the records.
    }
    
    public function render()
    {
        $this->loadPosts();
        
        return view('livewire.show-posts');
    }
}
