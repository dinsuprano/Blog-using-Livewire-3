<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-8">
            <!-- Maybe a site title or logo here -->
            <h1>BLOG</h1>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Search posts...">
                {{-- <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search fa-2x"></i></span>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="row">
        @if($posts->count())
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                    <!-- Display the first image of the post -->
                        @if($post->photos->first())
                            <img src="{{ Storage::url($post->photos->first()->photo_path) }}" alt="{{ $post->title }}" class="card-img-top" >
                        @endif
                        <div class="card-body">
                            <h5><a href="{{ route('single.post', $post->id)}}">{{ $post->title }}</a></h5>
                            <p>{{ Str::limit($post->content, 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <p class="text-center">No post found with the given title or content.</p>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
    {{ $posts->links() }}
    </div>

</div>