<div class="container mt-5">
    @if (session()->has('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
    @endif
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title"
        wire:model.live="title">@error('title') <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" rows="4"
        wire:model.live="content"></textarea>
        @error('content') <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="photos" class="form-label">Upload Photos</label>
        <input type="file" class="form-control" id="photos"
        wire:model.live="photos" multiple>
        @error('photos.*') <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!-- Image Preview for CreatePost -->
    @if ($photos)
        <div class="mb-3">
            @foreach($photos as $photo)
                <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail"
                width="100">
            @endforeach
        </div>
    @endif
    <button class="btn btn-primary" wire:click="save">Create Post</button>
</div>