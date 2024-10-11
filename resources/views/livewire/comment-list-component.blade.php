<div>
    @if(!auth()->check())
        <div>
            <?php session(['url.intended' => url()->current()]); ?>
            Want to join the discussion? <a href="{{ route('login') }}">Login</a>
            or <a href="{{ route('register') }}">Register</a>
        </div>
    @endif
    <!-- Display Comments -->
    @foreach($comments as $comment)
        <div>
            <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
            <!-- Nested CommentComponent for replies -->
            @livewire('comment-component', ['comment' => $comment],key($comment->id))
        </div>
    @endforeach
    <!-- Comment Input Box -->
    @if(auth()->check()) <!-- Only show comment box if user is logged in -->
        <div>
            <textarea wire:model="newComment" placeholder="Add a comment..."></textarea>
            @error('newComment') <span class="error">{{ $message }}</span>
            @enderror
            <button wire:click="addComment">Submit</button>
        </div>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to comment.</p>
    @endif
</div>