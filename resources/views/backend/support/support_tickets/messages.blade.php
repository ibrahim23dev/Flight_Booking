<div>
    @foreach ($supportTicket->replies as $index=> $reply)
        <div class="media" id="message-{{ $index }}">
            @if ((int)$reply->user_id === (int)$user->id)
            <div class="media-body text-right">
                <span class="msg-send bg-primary">{{ $reply->reply_text }}</p>
                <span><i class="icofont icofont-wall-clock f-12"></i> {{ $reply->created_at->format('h:i A') }}</p>
            </div>
                <div class="media-right friend-box">
                    <a href="#">
                        <img class="media-object img-radius" src="{{ asset('storage/images/users/' . $user->image) }}" alt="{{ $user->name }}">
                    </a>
                </div>
            @else
                <div class="media-left friend-box">
                    <a href="#">
                        <img class="media-object img-radius" src="{{ asset('storage/images/users/'.$reply->user->image) }}" alt="{{$reply->user->image}}">
                    </a>
                </div>
                <div class="media-body">
                    <span class="msg-send">{{ $reply->reply_text }}</p>
                    <span><i class="icofont icofont-wall-clock f-12"></i> {{ $reply->created_at->format('h:i A') }}</p>
                </div>
            @endif
        </div>
        
    @endforeach
</div>
