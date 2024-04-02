<li class="chat-single-box card-shadow bg-white active" data-id="{{ $conversation->id }}">
    <div class="had-container">
        <div class="chat-header p-10 bg-gray">
            <div class="user-info d-inline-block f-left">
                <div class="box-live-status bg-{{($conversation->user2->active_status)==true ? 'success' : 'danger'}}  d-inline-block m-r-10"></div><a href="#">{{ $conversation->user2->name }}</a>
            </div>
            <div class="box-tools d-inline-block"><a href="#" class="mini"><i
                        class="icofont icofont-minus f-20 m-r-10"></i></a><a class="close" href="#"><i
                        class="icofont icofont-close f-20"></i></a></div>
        </div>
        <div class="chat-body p-10">
            <div class="message-scrooler">
                <div class="messages" id="chat_box_{{ $conversation->id }}"></div>
            </div>
        </div>
        <div class="chat-footer b-t-muted">
            <form id="paper-form_{{ $conversation->id }}" onsubmit="return false;">
            <div class="input-group write-msg">
                <input type="text" class="form-control input-value"
                    placeholder="Type a Message" id="message-input_{{ $conversation->id }}"><span class="input-group-btn">
                        <button id="paper-btn_{{ $conversation->id }}" class="btn btn-primary send-message" type="submit" onclick="sendFormMessage({{ $conversation->id }})"><i class="icofont icofont-paper-plane"></i></button></span>
            </div>
            <form>
      
        </div>
    </div>
</li>
