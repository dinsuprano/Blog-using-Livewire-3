<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Comment;

class EditComment extends Component
{
    // Public properties are directly accessible in the component's view.
    public $commentId; // Stores the ID of the comment to be edited.
    public $content; // Stores the content of the comment.
    // The mount method is called when the component is instantiated.
    // It's used here to initialize the component with the comment's data.
    public function mount($commentId)
    {
        $this->commentId = $commentId;
        $this->content = Comment::find($commentId)->content;
    }
    // The save method updates the comment in the database.
    public function save()
    {
        // Validate the content field to ensure it meets the requirements.
        $this->validate([
            'content' => 'required|min:5',
        ]);
        // Find the comment by ID and update its content.
        $comment = Comment::find($this->commentId);
        $comment->content = $this->content;
        $comment->save();
        // Flash a session message to inform the user of the successful update.
        session()->flash('message', 'Comment updated successfully.');
        // Redirect the user to a different route (e.g., manage posts page).
        return redirect()->route('manage.posts');
    }
    // The render method returns the view for the component.
    // The view file for this component should be located at resources/views/livewire/edit-comment.blade.php
    public function render()
    {
        return view('livewire.edit-comment')->extends('layouts.app');
    }
}