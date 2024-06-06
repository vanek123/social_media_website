@extends('layouts.app')

@section('content')

<!--<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="background-color: #1E1E24;">
                    <h2 class="card-title text-light">User List</h2>
                    <input type="text" class="form-control mb-3" id="user-search" placeholder="Search users...">
                    <ul class="list-group">
                        @foreach($users as $user)
                            @php
                                $isSelected = isset($selectedUser) && $user->id == $selectedUser->id;
                            @endphp

                            <li class="list-group-item d-flex align-items-center {{ $isSelected ? 'selected-user' : '' }}" style="background-color: #25262E">
                                <a href="{{ route('chatWithUser', $user->id) }}" class="d-flex align-items-center text-decoration-none text-light">
                                    <img src="{{ $user->profile->profileImage() }}" alt="{{ $user->username }}" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                    <div>
                                        <p class="mb-0">{{ $user->username }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center text-light" style="background-color: #1E1E24;">
                    @if(isset($selectedUser))
                        <img src="{{ $selectedUser->profile->profileImage() }}" alt="{{ $selectedUser->username }}" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                        <h2 class="card-title mb-0">{{ $selectedUser->username }}</h2>
                    @else
                        <h2 class="card-title mb-0">Chat</h2>
                    @endif
                </div>
                <div class="card-body chat-messages text-light m-0" id="chat_window" style="background-color: #25262E">
                    @if(isset($messages) && sizeof($messages) > 0)
                        @foreach($messages as $message)
                            @php
                                $fmt = new IntlDateFormatter( "en_GB" ,IntlDateFormatter::FULL, IntlDateFormatter::FULL, null,IntlDateFormatter::GREGORIAN, "LLLL d, yyyy HH:mm");
                                $message_sent = ucfirst(datefmt_format($fmt, strtotime($message['created_at'])));
                            @endphp

                            @if ($message['message_sender'] == $selectedUsername)
                                <div class="{{ $message['message_sender'] == auth()->id() ? 'text-right' : 'text-left' }}">
                                    <img src="{{$selectedUserImage}}" style="max-width: 40px;" class="rounded-circle">
                                    <strong>{{$message['message_sender']}}</strong>
                                    <p>{{ $message_sent}}</p> 
                                    <p>{{ $message['content'] }}</p>
                                </div>
                            @else
                                <div class="{{ $message['message_sender'] == auth()->id() ? 'text-right' : 'text-left' }}">
                                    <img src="{{$authUserImage}}" style="max-width: 40px;" class="rounded-circle">
                                    <strong>{{$message['message_sender']}}</strong> 
                                    <p class="mb-2">{{ $message_sent }}</p>
                                    <p>{{ $message['content'] }}</p>
                                </div>
                            @endif
                            
                        @endforeach
                    @else
                        <p>Be the first to send a message!</p>
                    @endif
                </div>
                <div class="card-footer chat-input" style="background-color: #1E1E24;">
                    @if(isset($selectedUser))
                        <form id="message_form" action="{{ route('chat.send_message') }}" method="POST" class="d-flex">
                            @csrf
                            <input type="hidden" name="message_sender" value='{{ auth()->user()->username }}'>
                            <input type="hidden" name='message_receiver' value='{{ $selectedUser->username }}'>
                            <textarea id="new_message_text" name="content" rows="3" form="message_form"></textarea>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="custom-container text-light">
        <div class="custom-sidebar">
            <div class="custom-card">
                <div class="custom-card-body">
                    <h2 class="custom-card-title">User List</h2>
                    <input type="text" class="custom-search-input" id="user-search" placeholder="Search users...">
                    <ul class="custom-user-list">
                        @foreach($users as $user)
                            @php
                                $isSelected = isset($selectedUser) && $user->id == $selectedUser->id;
                            @endphp

                            <li class="custom-user-item {{ $isSelected ? 'custom-selected-user' : '' }}">
                                <a href="{{ route('chatWithUser', $user->id) }}" class="custom-user-link">
                                    <img src="{{ $user->profile->profileImage() }}" alt="{{ $user->username }}" class="custom-user-avatar">
                                    <div class="custom-user-info">
                                        <p class="custom-user-name">{{ $user->username }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="custom-main">
            <div class="custom-card">
                <div class="custom-card-header">
                    @if(isset($selectedUser))
                        <img src="{{ $selectedUser->profile->profileImage() }}" alt="{{ $selectedUser->username }}" class="custom-user-avatar">
                        <h2 class="custom-card-title">{{ $selectedUser->username }}</h2>
                    @else
                        <h2 class="custom-card-title">Chat</h2>
                    @endif
                </div>
                <div class="custom-card-body custom-chat-messages" id="chat_window">
                    @if(isset($messages) && sizeof($messages) > 0)
                        @foreach($messages as $message)
                            @php
                                $fmt = new IntlDateFormatter( "en_GB" ,IntlDateFormatter::FULL, IntlDateFormatter::FULL, null,IntlDateFormatter::GREGORIAN, "LLLL d, yyyy HH:mm");
                                $message_sent = ucfirst(datefmt_format($fmt, strtotime($message['created_at'])));
                            @endphp

                            @if ($message['message_sender'] == $selectedUsername)
                                <div class="custom-message custom-message-sender">
                                    <div class="custom-message-content">
                                        <img src="{{$selectedUserImage}}" class="custom-message-avatar">
                                        <strong>{{$message['message_sender']}}</strong>
                                        <p>{{ $message_sent}}</p> 
                                        <p>{{ $message['content'] }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="custom-message custom-message-receiver">
                                    <div class="custom-message-content">
                                        <img src="{{$authUserImage}}" class="custom-message-avatar">
                                        <strong>{{$message['message_sender']}}</strong> 
                                        <p>{{ $message_sent }}</p>
                                        <p>{{ $message['content'] }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p>Be the first to send a message!</p>
                    @endif
                </div>
                <div class="custom-card-footer custom-chat-input">
                    @if(isset($selectedUser))
                        <form id="message_form" action="{{ route('chat.send_message') }}" method="POST" class="custom-message-form">
                            @csrf
                            <input type="hidden" name="message_sender" value='{{ auth()->user()->username }}'>
                            <input type="hidden" name='message_receiver' value='{{ $selectedUser->username }}'>
                            <textarea id="new_message_text" name="content" rows="3" form="message_form"></textarea>
                            <button type="submit" class="custom-send-button">Send</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
</div>


<script>
    $(function() {
    $("#chat_window").scrollTop($("#chat_window")[0].scrollHeight);

    // Ajax request for sending a message
    $('#message_form').submit(function(event) {
        var form_id = $(this).attr('id');
        event.preventDefault();
        var formData = $(this).serializeArray();

        $.ajax({
            url: `{{ route('chat.send_message') }}`,
            type: 'post',
            data: formData,
            success: function(response) {

                var content = response.content;
                content = content.replace(/\n/g, "<br />");

                var image = response.image;
                var name = response.name;
                var time = response.time;
                var message_sender = response.message_sender;

                var message = ` <div class="{{ `+message_sender+` == auth()->id() ? 'text-right' : 'text-left' }}">
                                    <img src="`+image+`" style="max-width: 40px;" class="rounded-circle">
                                    <strong>`+message_sender+`</strong>
                                    <p>`+content+`  </p>
                                </div>`;

                $('#chat_window').append(message);
                $("#chat_window").scrollTop($("#chat_window")[0].scrollHeight);
                $('#new_message_text').val('');
                
                
            },

            error: function(response) {
                alert('error');
            }
        });
    });

    // Refreshing the page for possible messages every 3 seconds
    var intervalId = window.setInterval(function() {
        refresh_chat();
    }, 3000);

    // Ajax request for refreshing the chat window
    function refresh_chat() {
        $.ajax({
            url: `{{ route('refresh_messages') }}`,
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {user: `{{ $selectedUsername }}`},
            success: function(response) {
                $('#chat_window').load(' #chat_window > *');


                var chat_window = document.getElementById('chat_window');
                var scroll = false;

                //console.log(response.user);

                if (Math.abs(chat_window.scrollTop - (chat_window.scrollHeight - chat_window.offsetHeight)) <= 5) {
                    scroll = true;
                }

                // a small delay so that element could properly render
                setTimeout(() => {
                    if (scroll) {
                        var div = document.querySelector('#chat_window');
                        div.scrollTop = div.scrollHeight;

                    }
                }, 1000);
            
            },

            error: function(response) {
                alert('error');
            }
        });
    }


});

document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('user-search');
        const userList = document.querySelector('.custom-user-list');
    
        searchInput.addEventListener('input', function() {
            const query = searchInput.value;
    
            fetch('/chat_search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ query: query })
            })
            .then(response => response.json())
            .then(data => {
                userList.innerHTML = '';
    
                if (data.length > 0) {
                    data.forEach(user => {
                        const userItem = document.createElement('li');
                        userItem.classList.add('custom-user-item');
                        
                        const userLink = document.createElement('a');
                        userLink.href = `/chat/${user.id}`;
                        userLink.classList.add('custom-user-link');
    
                        const userAvatar = document.createElement('img');
                        userAvatar.src = user.profile_image; // Assuming a default image if none is provided
                        userAvatar.alt = user.username;
                        userAvatar.classList.add('custom-user-avatar');
    
                        const userInfo = document.createElement('div');
                        const userName = document.createElement('p');
                        userName.textContent = user.username;
    
                        userInfo.appendChild(userName);
                        userLink.appendChild(userAvatar);
                        userLink.appendChild(userInfo);
                        userItem.appendChild(userLink);
    
                        userList.appendChild(userItem);
                    });
                } else {
                    const noUserItem = document.createElement('li');
                    noUserItem.classList.add('custom-user-item');
                    noUserItem.textContent = 'No users found';
                    userList.appendChild(noUserItem);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
    </script>
</script>
@endsection
