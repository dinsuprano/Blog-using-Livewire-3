<div class="container mt-5">
    <h3 class="mb-4">Edit Comment</h3>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="form-group">
        <textarea wire:model="content" class="form-control" rows="5"></textarea>
        @error('content') <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button wire:click="save" class="btn btn-primary">Save Changes</button>
</div