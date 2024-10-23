<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentListComponent extends Component
{
    use WithPagination;

    public $post;
    public $newComment;
    public $replyingTo = null; // To track which comment is being replied to
    public $replyContent = []; // To store replies for each comment

    protected $rules = [
        'newComment' => 'required|min:5',
        'replyContent.*' => 'required|min:5', // Validation for replies
    ];

    public function mount($postId)
    {
        $this->post = Post::find($postId);
    }

    // Function to add new comment
    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:5',
        ]);

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'content' => $this->newComment,
        ]);

        $this->newComment = ''; // Clear comment input
        $this->post->load('topLevelComments'); // Refresh comment list
    }

    // Function to add a reply to a specific comment
    public function addReply($commentId)
    {
        $this->validate([
            'replyContent.' . $commentId => 'required|min:5',
        ]);

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'content' => $this->replyContent[$commentId], // Use dynamic reply input
            'parent_comment_id' => $commentId, // Link to the parent comment
        ]);

        $this->replyContent[$commentId] = ''; // Clear the reply input for that comment
        $this->replyingTo = null; // Reset the replying state
        $this->post->load('topLevelComments'); // Refresh comment list
    }

    // Fetch and return top-level comments and their replies
    public function getComments()
    {
        return $this->post->topLevelComments()
            ->withCount('likes') // Count likes
            ->with([
                'user', 
                'likes' => function($query) {
                    $query->where('user_id', auth()->id()); // Check if the user liked the comment
                },
                'replies.user' // Include the replies and the users who posted them
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    // Like or unlike a comment
    public function toggleLike($commentId)
    {
        $comment = Comment::find($commentId);
        $user = auth()->user();

        // Check if the user has already liked the comment
        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // If already liked, remove the like
            $like->delete();
        } else {
            // If not liked, add a new like
            Like::create([
                'user_id' => $user->id,
                'comment_id' => $comment->id,
            ]);
        }
    }

    public function replyToComment($commentId)
    {
        // Set which comment is being replied to
        $this->replyingTo = $commentId;
    }

    public function render()
    {
        // Use the getComments method to fetch the comments
        $comments = $this->getComments();

        return view('livewire.comment-list-component', [
            'comments' => $comments,
        ]);
    }
}
