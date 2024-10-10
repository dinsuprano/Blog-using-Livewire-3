<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
    @endif


    <form wire:submit="savePost">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" wire:model.live="title">
            @error('title') <span class="error">{{ $message }}</span>@enderror

            <label for="content">Content:</label>
            <input id="content" wire:model.live="content">
            @error('content') <span class="error">{{ $message}}</span> @enderror
        </div>
        <br>

        <!-- Image Upload -->
        <div>
            <input type="file" wire:model="photos" multiple>
            @error('photos.*') <span class="error">{{ $message }}</span>@enderror

           <!-- Multiple Image Preview -->
            @if ($photos)
                @foreach ($photos as $photo)
                    <img src="{{ $photo->temporaryUrl() }}" width="100">
                @endforeach
            @endif
        </div>

        <button type="submit">Save</button>
    </form>
</div>