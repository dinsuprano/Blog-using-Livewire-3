<div>
    <!-- Display nested replies -->
    @foreach($replies as $reply)
        <div style="margin-left: 20px;">
            <p><strong>{{ $reply->user->name }}</strong>: {{ $reply->content }}</p>
            <!-- Nested CommentComponent for deeper replies -->
            @livewire('comment-component', ['comment' => $reply],key($reply->id))
        </div>
    @endforeach
    <!-- Display the reply form for authenticated users ONLY for the main comment -->
    @if(!isset($reply))
        @auth
        <div>
            <textarea wire:model="replyContent" placeholder="Write a reply..."></textarea>
            @error('replyContent') <span class="error">{{ $message}}</span> @enderror
            <button wire:click="postReply({{ $comment->id}})">Reply</button>
        </div>
    @else
        <button @click="open = true" class="btn btnprimary">Reply</button>@endif
    @endif
</div>