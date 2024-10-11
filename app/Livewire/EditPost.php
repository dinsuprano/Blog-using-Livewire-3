<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    public $postId; // Variable to store the post ID
    public $title; // Variable to store the post title
    public $content; // Variable to store the post content
    public $photos = []; // Array to store new photos to be uploaded
    public $existingPhotos = []; // Array to store existing photos from the database

    public function mount($postId)
    {
        $post = Post::find($postId); // Retrieve the post from the database
        $this->postId = $post->id; // Set the post ID
        $this->title = $post->title; // Set the post title
        $this->content = $post->content; // Set the post content
        $this->existingPhotos = $post->photos; // Set the existing photos
    }
    // Method to save the edited post
    public function save()
    {
        // Validate the input data
        $this->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'photos.*' => 'image|max:1024', // 1MB Max for photos
        ]);
        $post = Post::find($this->postId); // Find the post by ID
        // Update the post details
        $post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        // Handle new photo uploads
        foreach ($this->photos as $photo) {
        $photoPath = $photo->store('post-photos', 'public'); // Store the photo
        PostPhoto::create([ // Create a new PostPhoto record
            'post_id' => $this->postId,
            'photo_path' => $photoPath,
        ]);
    }
        // Redirect to the single post view
        return redirect()->route('single.post', $this->postId);
    }
    public function removePhoto($photoId)
    {

        $photo = PostPhoto::find($photoId); // Find the photo by ID
        if ($photo) {
        Storage::disk('public')->delete($photo->photo_path); // Delete the photo file
        $photo->delete(); // Delete the photo record
        }
        $this->existingPhotos = $this->existingPhotos->except($photoId);
        // Update the existing photos array
    }
    public function render()
    {
        return view('livewire.edit-post')->extends('layouts.app');
    }
}
