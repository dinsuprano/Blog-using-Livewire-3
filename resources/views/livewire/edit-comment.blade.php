<div>
    <h3>Edit Comment</h3>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <textarea wire:model="content"></textarea>
    @error('content') <span class="error">{{ $message }}</span> @enderror
    
    <button wire:click="save">Save Changes</button>
</div>