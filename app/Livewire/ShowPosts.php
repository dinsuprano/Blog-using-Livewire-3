<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    public $search = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $query = Post::query();
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%');
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.show-posts', compact('posts'));
    }
}
