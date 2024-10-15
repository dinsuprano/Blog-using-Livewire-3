<div x-data="{ open: false }">
    @foreach($replies as $reply)
        <div style="margin-left: 10px;" class="mb-2">
            <strong>{{ $reply->user->name }}</strong>: {{ $reply->content}}
            @livewire('comment-component', ['comment' => $reply], key($reply->id))
        </div>
    @endforeach

    @if(!isset($reply))
        @auth
            <div class="form-group">
                <textarea wire:model="replyContent" class="form-control" rows="3" placeholder="Write a reply..."></textarea>
                @error('replyContent') <span class="text-danger">{{ $message}}</span> @enderror
            </div>
            <button wire:click="postReply({{ $comment->id }})" class="btn btn-primary">Reply</button>
        @else
            <button @click="open = true" class="btn btn-primary">Reply</button>
        @endif
    @endif

    <!--A modal for non-authenticated users-->
    <div x-show="open" class="modal-backdrop">
        <div class="modal-content-text">
        <h4>Please Login</h4>
        <p>You need to be logged in to reply. <a href="{{
        route('login') }}">Login</a> or <a href="{{ route('register')}}">Register</a></p>
        <button @click="open = false" class="btn btn-secondary">Close</button>
        </div>
    </div>

</div>