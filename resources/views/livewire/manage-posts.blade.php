
<div>
    @if(auth()->user() && auth()->user()->isAdmin())
    <p>You are an admin!</p>@elseif(auth()->user() && auth()->user()->isUser())
    <p>You are a regular user!</p>
    @endif
    @foreach($posts as $post)
    <div>
        <h3><a href="{{ route('single.post', $post->id) }}">{{ $post->title }}</a></h3>
        <p>{{ Str::limit($post->content, 100) }}</p>
        <a href="{{ route('edit.post', $post->id) }}">Edit</a>
        <button wire:click="deletePost({{ $post->id}})">Delete</button>
    </div>
    @endforeach
    {{ $posts->links() }}
</div>
