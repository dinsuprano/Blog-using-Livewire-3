<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class SinglePost extends Component
{
    public $postId;
    public function mount($postId){
        $this->postId = $postId;
    }
    public function render()
    {
        // return view('livewire.single-post',[
        //     'posts' => Post::find($this->postId),
        // ]);

        $posts = Post::find($this->postId);
        if (!$posts) {
            return view('livewire.post-not-found')->extends('layouts.app');
        }

        return view('livewire.single-post', [
            'posts' => $posts,
        ])->extends('layouts.app');
    }
}
