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
                        <img src="{{ asset('storage/avatar/image.png') }}" 
                            alt="{{ $comment1->user->name }}'s avatar" 
                            class="rounded-circle" width="50" height="50">
                        <div class="ms-3">
                            <h5 class="card-title mb-0">
                                <strong class="text-primary">{{ $comment1->user->name }}</strong>
                            </h5>
                            <small class="text-muted">
                                {{ $comment1->user->role == 'admin' ? 'Author' : 'User' }}
                            </small>
                        </div>
                    </div>

                    <!-- Comment Content -->
                    <p class="card-text">{{ $comment1->content }}</p>
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

                        <!-- Reply Form -->
                        @if($replyingTo === $comment1->id)
                            <div class="form-group mt-3">
                                <textarea wire:model.lazy="replyContent.{{ $comment1->id }}" class="form-control" rows="2" placeholder="Write a reply..."></textarea>
                                @error('replyContent.' . $comment1->id) <span class="text-danger">{{ $message }}</span> @enderror
                                <button wire:click="addReply({{ $comment1->id }})" class="btn btn-success btn-sm mt-2">Post Reply</button>
                            </div>
                        @endif
                    @endif
                        <!-- Display Replies -->
                        @if($comment1->replies->isNotEmpty())
                            <div class="mt-3 ps-5">
                                @foreach($comment1->replies as $reply)
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <img  src="{{ asset('storage/avatar/image.png') }}"  
                                                    alt="{{ $reply->user->name }}'s avatar" 
                                                    class="rounded-circle" width="40" height="40">
                                                <div class="ms-3">
                                                    <h6 class="card-title mb-0">
                                                        <strong class="text-primary">{{ $reply->user->name }}</strong>
                                                    </h6>
                                                    <div>
                                                        <small class="text-muted">
                                                            {{ $reply->user->role == 'admin' ? 'Author' : 'User' }}
                                                        </small>
                                                    </div>
                                                    <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <p class="card-text">{{ $reply->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $comments->links() }}
        </div>

        <!-- Loading Indicator -->
        <div wire:loading>
            Loading comments...
        </div>
    </div>
</div>
