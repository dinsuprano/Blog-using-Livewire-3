<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <!-- Post Title -->
            <h1 class="display-4 mb-5">{{ $posts->title }}</h1>
            <!-- Post Images -->
            @foreach($posts->photos as $photo)
                <div class="mb-4">
                    <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $posts->title }}" class="img-fluid rounded shadow">
                </div>
            @endforeach
            <!-- Post Content -->
            <div class="post-content text-justify mb-5">
                <p>{{ $posts->content }}</p>
            </div>
            <!-- Divider -->
            <hr class="my-5">
            <!-- Comments Section -->
            <h2 class="h4 mb-4">Comments</h2>
            @livewire('comment-list-component', ['postId' => $posts->id])
            
        </div>
    </div>
</div>