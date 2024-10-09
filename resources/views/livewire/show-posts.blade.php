<div wire:poll.10s>
    <h1>All Posts</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
    @endif
    <ul>
        @foreach($posts as $post)
            <div>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <livewire:show-comments :postId="$post->id" :key="$post->id" />
            </div>
            @endforeach
    </ul>

</div>