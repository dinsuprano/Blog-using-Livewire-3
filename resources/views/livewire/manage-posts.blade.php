<div wire:poll.5s class="container mt-5">

    @if (session()->has('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
    @endif

    <div class="mb-3">
        <input type="text" wire:model.live="search" class="form-control"
        placeholder="Search posts...">
    </div>

    <!-- Button to create a new post -->
    <a href="{{ route('create.post') }}" class="btn btn-primary mb-3">Create New Post</a>
    @if($posts->count())
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title"><a href="{{ route('single.post',$post->id) }}">{{ $post->title }}</a></h3>
                    
                    <p class="card-text">{{ Str::limit($post->content, 100)}}</p>

                    <a href="{{ route('edit.post', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <button wire:click="deletePost({{ $post->id }})"class="btn btn-danger btn-sm">Delete</button>

                    <!-- Display comments count for the post -->
                    <h4 class="mt-3">Comments: {{ $post->comments->count()}}</h4>

                    @foreach($post->comments as $comment)
                        <div class="ml-4 mb-2">
                            <p><strong>{{ $comment->user->name }}:</strong> {{$comment->content }}</p>
                            <!-- Edit and Delete buttons for the comment -->
                            @if(auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id)<a href="{{ route('edit.comment', $comment->id) }}" class="btn btn-warning btn-sm">Edit Comment</a>
                                <button wire:click="deleteComment({{ $comment->id }})" class="btn btn-danger btn-sm">Delete Comment</button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">No post found with the given title or content.</p>
    @endif

    <div class="d-flex justify-content-center">
    {{ $posts->links() }}
    </div>

</div>