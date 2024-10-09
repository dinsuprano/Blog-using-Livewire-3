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
        <button type="submit">Save</button>
    </form>
</div>