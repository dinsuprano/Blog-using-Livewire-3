<div class="container mt-5">
    @if(!auth()->check())
        <div class="alert alert-info">
            <?php session(['url.intended' => url()->current()]); ?>
            Want to join the discussion? <a href="{{ route('login')}}">Login</a> or <a href="{{ route('register') }}">Register</a>
        </div>
    @endif

    @if(auth()->check())
        <div class="form-group">
            <textarea wire:model.lazy="newComment" class="form-control" rows="2" placeholder="Add a comment..."></textarea>
            @error('newComment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group" style="padding-top:10px">
            <button wire:click="addComment" class="btn btn-primary">Post Comment</button>
        </div>
    @endif

    <hr>

    <div class="form-group">
        @foreach($comments as $comment1)
            <div class="card mb-3">
                <div class="card-body">
                    <!-- Author Section -->
                    <div class="d-flex align-items-center mb-2">
                        <!-- Avatar (optional) -->
                        <img src="{{ $comment1->user->avatar_url ?? 'default-avatar.png' }}" 
                             alt="{{ $comment1->user->name }}'s avatar" 
                             class="rounded-circle" 
                             width="50" height="50"> <!-- Optional avatar -->

                        <!-- Author's Name and Label -->
                        <div class="ms-3">
                            <h5 class="card-title mb-0">
                                <strong class="text-primary">{{ $comment1->user->name }}</strong> <!-- Author's name -->
                            </h5>

                            @if($comment1->user->role == "admin")
                                <small class="text-muted">Author</small> <!-- Author label -->
                            @elseif($comment1->user->role == "user")
                                <small class="text-muted">User</small> <!-- Author label -->
                            @endif
                            
                        </div>
                    </div>

                    <!-- Comment Content -->
                    <p class="card-text">{{ $comment1->content }}</p>

                    <!-- Comment Timestamp -->
                    <p class="card-text">
                        <small class="text-muted">Posted {{ $comment1->created_at->diffForHumans() }}</small>
                    </p>

                    @if(auth()->check())
                    <!-- Like Button -->
                    <div class="d-flex align-items-center">
                        <button wire:click="toggleLike({{ $comment1->id }})" class="btn btn-outline-primary btn-sm">
                            {{ $comment1->isLikedByUser ? 'Unlike' : 'Like' }} ({{ $comment1->likes_count }})
                        </button>
                        <!-- Reply Button --> 
                        <button wire:click="replyToComment({{ $comment1->id }})" class="btn btn-outline-secondary btn-sm" style="margin-left:5px">
                            Reply
                        </button>
                    </div>
                    @endif

                </div>
            </div>
        @endforeach

        <!-- Livewire Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $comments->links() }}
        </div>

        <!-- Loading Indicator -->
        <div wire:loading>
            Loading comments...
        </div>
    </div>
</div>
