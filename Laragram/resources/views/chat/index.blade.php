@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">User List</h2>
                    <input type="text" class="form-control mb-3" id="user-search" placeholder="Search users...">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <a href="{{ route('chatWithUser', $user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center text-decoration-none text-dark">
                                <img src="{{ $user->profile->profileImage() }}" alt="{{ $user->username }}" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                <div>
                                    <p class="mb-0">{{ $user->username }}</p>
                                </div>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                        <h2 class="card-title mb-0">Chat</h2>
                </div>
                <div class="card-body chat-messages" id="chat_window">
                    <p>Choose use to start conversation</p>
                </div>
                <div class="card-footer chat-input">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
