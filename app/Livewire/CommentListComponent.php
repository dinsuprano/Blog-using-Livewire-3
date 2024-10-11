<?php

namespace App\Livewire;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class CommentListComponent extends Component
{
    // These public properties are accessible in the component's view.
    public $post; // The post for which comments will be shown.
    public $comment;
    public $newComment; // The content of the new comment to be added.
    // Mount the component with the post's ID and load the post from the database.
    public function mount($postId)
    {
        $this->post = Post::find($postId);
    }
    // Add a new comment to the database.
    public function addComment()
    {
        // Validate the new comment input.
        $validatedData = $this->validate([
            'newComment' => 'required|min:5',
        ]);
        // Create the new comment and associate it with the post and the authenticated user.
        $comment = Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'content' => $this->newComment,
        ]);
        // Reset the new comment input field to be empty.
        $this->newComment = '';
        // Push the new comment to the post's top-level comments collection.
        // This ensures that the new comment will be included in the list without needing to re-fetch from the database.
        $this->post->topLevelComments->push($comment);
    }
    // Render the component view with the necessary data.
    public function render()
    {
        return view('livewire.comment-list-component', [// Fetch top-level comments for the post, eager load user relationships, and order by creation date.
            'comments' => $this->post->topLevelComments()->with('user')->orderBy('created_at', 'desc')->get()
        ]);
    }
}