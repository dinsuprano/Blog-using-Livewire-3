<div>
    @foreach($posts as $post)
        <div>
        <h3><a href="{{ route('single.post', $post->id) }}">{{ $post->title }}</a></h3>
        <p>{{ Str::limit($post->content, 100) }}</p>
        </div>
    @endforeach
    {{ $posts->links() }}
</div>