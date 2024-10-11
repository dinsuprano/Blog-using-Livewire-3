<div>
    <h2>Edit Post</h2>
    <input type="text" wire:model="title" placeholder="Title">
    @error('title') <span class="error">{{ $message }}</span> @enderror
    <textarea wire:model="content" placeholder="Content"></textarea>
    @error('content') <span class="error">{{ $message }}</span> @enderror
    <div>

        @foreach($existingPhotos as $photo)
            <img src="{{ Storage::url($photo->photo_path) }}" alt="{{
            $title }}" width="100">
            <button wire:click="removePhoto({{ $photo->id
            }})">Delete</button>
        @endforeach
    </div>
    <div>
        <label>Upload New Photos:</label>
        <input type="file" wire:model="photos" multiple>
        @error('photos.*') <span class="error">{{ $message }}</span>
        @enderror
        <!-- Image Preview for EditPost -->
        @if ($photos)
            @foreach($photos as $photo)
                <img src="{{ $photo->temporaryUrl() }}" width="100">
            @endforeach
        @endif
    </div>
    <button wire:click="save">Update Post</button>
</div>