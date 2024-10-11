<div class="container mt-5">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" wire:model.live="title">
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    
    <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea id="content" class="form-control" wire:model.live="content"></textarea>
        @error('content') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="photos" class="form-label">Upload Photos</label>
        <input type="file" class="form-control" id="file" wire:model.live="photos" multiple>
        @error('content') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    
    <!-- Multiple Image Preview -->
    @if ($photos)
    <div class="mb-3">
        @foreach ($photos as $photo)
            <img src="{{ $photo->temporaryUrl() }}" width="100" class="img-thumbnail" width="100">
        @endforeach
    </div>
    @endif

    <button type="submit" class="btn btn-primary" wire:click="save">Save</button>

</div>
