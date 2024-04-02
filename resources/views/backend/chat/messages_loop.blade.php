@foreach ($messages as $message)
    @if ((int)auth()->user()->id == (int)$message->sender_id)
    <div class="message out no-avatar media">
        <div class="body media-body text-right p-l-50">
            <div class="content msg-reply f-12 bg-primary d-inline-block">{{ $message->content }}</div>
            <div class="seen">
                <i class="fa fa-clock-o f-12 m-r-5 txt-muted d-inline-block"></i>
                <span>{{ $message->created_at->diffForHumans() }}</span>
                <div class="clear"></div>
            </div>
        </div>
        <div class="sender media-right friend-box">
            <a href="javascript:void(0);" title="Me">
                <img src="{{ asset('storage/images/users/' . $message->sender->image) }}" class="img-chat-profile" alt="{{ $message->sender->name }}">
            </a>
        </div>
    </div>
    @else

    <div class="message out no-avatar media">
        <div class="sender media-left friend-box">
            <a href="javascript:void(0);" title="{{ $message->sender->name }}">
                <img src="{{ asset('storage/images/users/' . $message->sender->image) }}" class="img-chat-profile" alt="{{ $message->sender->name }}">
            </a>
        </div>
        <div class="body media-body text-left">
            <div class="content msg-reply f-12 bg-dark text-white d-inline-block">{{ $message->content }}</div>
            <div class="seen">
                <i class="fa fa-clock-o f-12 m-r-5 txt-muted d-inline-block"></i>
                <span>{{ $message->created_at->diffForHumans() }}</span>
                <div class="clear"></div>
            </div>
        </div>

    </div>

    @endif
@endforeach
