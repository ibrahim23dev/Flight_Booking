@foreach ($conversations as $conversation)
    @php
        $otherUser = ($conversation->user1_id == auth()->user()->id) ? $conversation->user2 : $conversation->user1;
        $hasUnreadMessages = $conversation->messages()->where('receiver_id', auth()->user()->id)->where('is_read', false)->exists();
    @endphp

    <div class="media userlist-box" data-id="{{ $conversation->id }}" data-status="{{($otherUser->active_status)==true ? 'online' : 'offline'}}"
         data-username="{{ $otherUser->name }}" data-toggle="tooltip" data-placement="left"
         title="{{ $otherUser->name }}">
        <a class="media-left" href="#">
            <img class="media-object" src="{{ asset('storage/images/users/' . $otherUser->image) }}" alt="image">

            <div class="live-status bg-{{($otherUser->active_status)==true ? 'success' : 'danger'}}"></div>
        </a>
        
        <div class="media-body">
            <div class="f-13 chat-header">
                {{ $otherUser->name }}
                @if ($hasUnreadMessages)
                    <span class="new-message-indicator badge badge-primary">New Messages</span>
                @endif
            </div>

        </div>
        <a href="{{ route('delete.conversation',$conversation->id) }}" style="position: absolute;right:15px;font-size:20px;" class="delete_conversation" title="delete">
            <i class="icofont icofont-ui-delete text-danger"></i>
      </a>
    </div>

@endforeach
