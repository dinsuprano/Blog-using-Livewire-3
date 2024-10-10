<div>
    <h4>Comments</h4>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <!-- Add a Comment -->
    <div>
        <input type="text" placeholder="Your Name" wire:model="author">
        <input type="text" placeholder="Your Comment" wire:model="newComment">
        <button wire:click="addComment">Add Comment</button>
    </div>
    <!-- Display Comments -->
    @foreach($comments as $comment)
        <div>
        <strong>{{ $comment->author }}</strong>
        <p>{{ $comment->content }}</p>
        </div>
    @endforeach
    {{ $comments->links() }}
</div>