<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ShowComments extends Component
{
    #[Reactive]
    public $postId;
    public $newComment;
    public $author;

    public function addComment()
    {
        Comment::create([
            'post_id' => $this->postId,
            'author' => $this->author,
            'content' => $this->newComment,
        ]);
        
        $this->newComment = '';
        $this->author = '';
    }

    public function render()
    {
        $comments = Comment::where('post_id', $this->postId)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('livewire.show-comments', ['comments' => $comments]);
    }
}
