@extends('layouts.app')

@section('content')

<!--<div class="container mt-5">
    <div class="row" style="height: 80vh;">
        <div class="col-md-4 d-flex flex-column">
            <div class="card flex-grow-1">
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
        <div class="col-md-8 d-flex flex-column flex-g">
            <div class="card flex-grow-1 d-flex flex-column text-light">
                <div class="card-header d-flex align-items-center" style="background-color: #1E1E24;">
                    <h2 class="card-title mb-0">Chat</h2>
                </div>
                <div class="card-body chat-messages flex-grow-1 mb-0 d-flex align-items-center justify-content-center" style="background-color: #25262E" id="chat_window">
                    <p>Choose user to start conversation</p>
                </div>
                <div class="card-footer chat-input flex-grow-1 mb-0 pb-0" style="background-color: #1E1E24;">

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
                    <!-- Example of dynamic content -->
                    @foreach($users as $user)
                        @php
                            $isSelected = isset($selectedUser) && $user->id == $selectedUser->id;
                        @endphp

                        <li class="custom-user-item custom-selected-user">
                            <a href="{{ route('chatWithUser', $user->id) }}" class="custom-user-link">
                                <img src="{{ $user->profile->profileImage() }}" alt="{{ $user->username }}" class="custom-user-avatar">
                                <div>
                                    <p>{{ $user->username }}</p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <!-- More user items can be added here -->
                </ul>
            </div>
        </div>
    </div>
    <div class="custom-main">
        <div class="custom-card">
            <div class="custom-card-header">
                <h2 class="custom-card-title">Chat</h2>
            </div>
            <div class="custom-card-body custom-chat-messages" id="chat_window">
                <p>Choose user to start conversation</p>
            </div>
            <div class="custom-card-footer custom-chat-input">
                <!-- Input elements can be added here -->
            </div>
        </div>
    </div>
</div>
@endsection
