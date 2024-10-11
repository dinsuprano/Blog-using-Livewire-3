<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Comment;
class CommentComponent extends Component
{
    // Public properties are accessible from the component's view.
    public $comment; // The comment object
    public $replyContent; // Content of the new reply
    // Validation rules for the component
    protected $rules = ['replyContent' => 'required|min:5',];
    // The mount method runs when the component is instantiated.
    // It is used to set the initial state of the component.
    public function mount($comment)
    {
        $this->comment = $comment;
    }
    // Method to handle posting a reply.
    public function postReply()
    {
        // Validate the reply content based on the rules defined.
        $this->validate();
            // Create a new comment record as a reply.
            Comment::create([
                'post_id' => $this->comment->post_id, // The ID of the post the comment belongs to.
                'parent_comment_id' => $this->comment->id, // The ID of the parent comment.
                'content' => $this->replyContent, // The content of the reply.
                'user_id' => auth()->id(), // The ID of the authenticated user.
            ]);
        // Reset the reply content after posting.
        $this->replyContent = '';
    }
    // Render method returns the view with the data.
    // It also retrieves the replies associated with the comment.
    public function render()
    {
        return view('livewire.comment-component', [
        // Fetch replies for the comment, with user data, ordered by creation date.
        'replies' => $this->comment->replies()->with('user')->orderBy('created_at', 'desc')->get()
        ]);
    }
}