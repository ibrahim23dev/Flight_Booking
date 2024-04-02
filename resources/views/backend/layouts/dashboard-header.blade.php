    
       {{-- end toast code here  --}}
    @include('backend.layouts.head-links')
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header" header-theme="theme6">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="{{route('dashboard')}}">
                            <img class="img-fluid" src="{{asset('storage/images/site_identity/'.getSiteIdentity()->logo_image)}}" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                            <li>
                                You are logged in as :
                                <a href="#">
                                    <span class="badge badge-primary badge-pill"> {{auth()->user()->roles[0]->name}}</span> 
                                </a>
                            </li>
                            {{-- <li>
                                Your balance :
                                <a href="#">
                                    <span class="badge badge-primary badge-pill"> {{getAuthUserBalance()}}</span> 
                                </a>
                            </li> --}}
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square"></i>
                                        <span class="badge bg-c-pink" id="new-message-count">0</span>
                                        
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6 id="messages-header">Messages</h6>
                                        </li>
                                        <li id="notification-list" style="max-height: 11rem;
                                        overflow-y: scroll;">
                                            {{-- <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="{{asset('assets/backend')}}\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user" id="last-sender"></h5>
                                                    <p class="notification-msg" >message</p>
                                                    <span class="notification-time">time</span>
                                                </div>
                                            </div> --}}
                                        </li>


                                    </ul>
                                </div>
                            </li>

                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">

                                      @if (auth()->user()->image)
                                      <img src="{{ asset('storage/images/users/' . auth()->user()->image) }}" alt="image" class="img-radius">
                                      @else
                                         <img src="{{asset('assets/backend')}}\files\assets\images\avatar-4.jpg" alt="image" class="img-radius"> 
                                      @endif
                                        <span>{{auth()->user()->name}}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="#!">
                                                <i class="feather icon-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('profile.edit')}}">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('password.change')}}">
                                                <i class="feather icon-shield"></i> Change Password
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('tickets.index')}}">
                                                <i class="feather icon-mail"></i> Support Tickets
                                            </a>
                                        </li>
                                       
                                        <li>
                                            <a href="{{route('logout')}}">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>

                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-inner-header">
                                <div class="right-icon-control">
                                    <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                    <div class="form-icon">
                                        <i class="icofont icofont-search"></i>
                                    </div>

                                </div>

                                <div class="back_chatBox">

                                </div>
                            </div>
                            <div class="main-friend-list">

                                {{-- conversations will go here  --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar inner chat start-->
            <div  id="showChat_inner_container">

            </div>
            <script>
            const userId = {{ auth()->user()->id }};
                
            async function updateUnreadMessages() {
    try {
        const response = await fetch('{{ route('messages.unread') }}');
        const data = await response.json();
        const unreadConversations = data.unreadConversations;
        const notificationList = document.querySelector('#notification-list');
        notificationList.innerHTML = '';

        if(unreadConversations.length>0){

        unreadConversations.forEach(conversation => {
        if (conversation.messages.length > 0) {

        const  unreadMessagesCount = conversation.messages.length;
        const lastMessage = conversation.messages[0];
        const senderName = (lastMessage.sender.id == conversation.user1.id)
            ? conversation.user1.name
            : conversation.user2.name;
              // Convert the timestamp to a JavaScript Date object
          const messageDate = new Date(lastMessage.created_at);

        // Format the date in the desired format
        const formattedDate = `${messageDate.toLocaleString('en-US', { month: 'long' })} ${messageDate.getDate()}, ${messageDate.getFullYear()}, ${messageDate.toLocaleTimeString('en-US')}`;

        const senderImageSrc = "{{ asset('storage/images/users/') }}" + "/" + lastMessage.sender.image;
        const chatLink="{{ route('chat') }}"
        const messageHtml = `
            <div class="media">
                <img class="d-flex align-self-center img-radius" src="${senderImageSrc}" alt="Sender Image">
                <div class="media-body mt-2">
                    <h5 class="notification-user">${senderName}
                         <sup class="label label-primary">${unreadMessagesCount} </sup>
                    </h5>
                    <p class="notification-msg">${lastMessage.content}</p>
                    <span class="notification-time">${formattedDate}</span>
                </div>

            </div>
       
        `;

        notificationList.insertAdjacentHTML('beforeend', messageHtml);
        document.querySelector('#messages-header').innerHTML=`New Messages | <a href="${chatLink}" class="label label-success"> View Chat     </a>
`;
    }
});
        }else{
        document.querySelector('#messages-header').innerHTML='No New Messages ' ;
    }


        
        const newMessageCount = unreadConversations.length;
        document.querySelector('#new-message-count').textContent = newMessageCount;
    } catch (error) {

    }
}

        // Call the updateUnreadMessages function when the page loads and at regular intervals
        $(document).ready(function () {
            updateUnreadMessages();
            setInterval(updateUnreadMessages, 3000); // Fetch every 3 seconds
        });

            </script>



            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                   
                  @include('backend.layouts.sidebar')
                 


                  