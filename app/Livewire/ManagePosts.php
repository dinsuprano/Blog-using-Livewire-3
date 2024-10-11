<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePosts extends Component
{
    use WithPagination;
    public function deletePost($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
    }
    
    public function render()
    {
        return view('livewire.manage-posts',[
            'posts' => Post::orderBy('created_at','desc')->paginate(5),
        ])->extends('layouts.app');
    }
}
