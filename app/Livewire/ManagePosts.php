<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePosts extends Component
{
    use WithPagination;
    public $search = '';
    public function deletePost($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        // Ensure that only the admin or the comment owner can delete the comment
        if (auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id) {
            $comment->delete();
            session()->flash('message', 'Comment deleted successfully.');
        } 
        else {
            session()->flash('error', 'Unauthorized action.');
        }
    }
    
    public function render()
    {
        return view('livewire.manage-posts', [
            'posts' => Post::with('comments.user')->where('title', 'like', '%' . $this->search .'%')
                ->orWhere('content', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10),
            ])->extends('layouts.app');
    }
}
