<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostPhoto;
use Livewire\WithFileUploads;
use Livewire\Component;

class CreatePost extends Component
{
    use WithFileUploads;
    public $title = '';
    public $content = '';

    public $photos = [];

    public function rules()
    {
        return [
         
            'title' => 'required|unique:posts|max:255',
            'content' => 'required|min:3',
            'photos.*' => 'image|max:1024',
        ];
    }

    public function save()
    {
        // Validate the input
        $this->validate();

        // Create the post
        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        // Process each photo
        foreach ($this->photos as $photo) {
            // Store the photo in the public storage
            $photoPath = $photo->store('post-photos', 'public');

            // Save the post photo record in the database
            PostPhoto::create([
                'post_id' => $post->id,
                'photo_path' => $photoPath,
            ]);
        }

        // Reset the input fields
        $this->reset(['title', 'content', 'photos']);
        session()->flash('message', 'Post Created');
        // Redirect with success message
        return redirect()->to('/create-post')->with('success', 'Post Created');
    }

    public function render()
    {
        return view('livewire.create-post')->extends('layouts.app');
    }
}
