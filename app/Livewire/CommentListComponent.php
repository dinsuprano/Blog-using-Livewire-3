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
    public $comment;
    public $newComment;

    public function mount($postId)
    {
        $this->post = Post::find($postId);
    }

    public function addComment()
    {
        $validatedData = $this->validate([
            'newComment' => 'required|min:5',
        ]);

        $comment = Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'content' => $this->newComment,
        ]);

        $this->newComment = '';
        $this->post->topLevelComments->push($comment);
    }

    // Separate function to fetch and return comments
    public function getComments()
    {
        return $this->post->topLevelComments()
            ->withCount('likes') // Add a likes count
            ->with(['user', 'likes' => function($query) {
                $query->where('user_id', auth()->id()); // Check if the user liked the comment
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

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

    public function replyToComment(){
        
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
