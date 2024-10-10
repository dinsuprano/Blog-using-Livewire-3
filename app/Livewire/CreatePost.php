<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;

class CreatePost extends Component
{

    use WithFileUploads;

    public $title;
    public $content;
    public $photos = [];

    public function savePost()
    {

        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);
        
        $post=Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        foreach ($this->photos as $photo) {
            $photoPath = $photo->store('post-photos', 'public');
            $post->photos()->create(['photo_path' => $photoPath]);
        }

        $this->title = '';
        $this->content = '';
        $this->photos = [];
                
        session()->flash('message', 'Post successfully created.');

    }

    public function render()
    {
        return view('livewire.create-post');
    }
}