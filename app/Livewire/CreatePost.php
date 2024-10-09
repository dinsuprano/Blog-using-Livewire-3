<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreatePost extends Component
{

    #[Rule('required')]
    #[Rule('min:5')]
    public $title;

    #[Rule('required')]
    #[Rule('min:10')]
    public $content;

    // //Validate Rules 
    // public function rules()
    // {
    //     return [
    //     'title' => 'required|min:3|unique:posts,title',
    //     'content' => 'required|min:3',
    //     ];
    // }
    public function savePost()
    {

        $this->validate();
        
        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        
        session()->flash('message', 'Post successfully created.');

    }



    // public function render()
    // {
    //     return view('livewire.create-post');
    // }
}