<div>
    <h1>{{ $posts->title }}</h1>
    <p>{{ $posts->content }}</p>

    @foreach ($posts->photos as $photo)
        <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $posts->title }}" width="300">
    @endforeach
</div>
