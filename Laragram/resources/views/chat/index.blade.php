@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">User List</h2>
                    <input type="text" class="form-control mb-3" id="user-search" placeholder="Search users...">
                    <!--<ul class="list-group">
                        <li class="list-group-item user">User 1</li>
                        <li class="list-group-item user">User 2</li>
                        <li class="list-group-item user">User 3</li>
                        <li class="list-group-item user">User 4</li>
                    </ul> -->
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Chat with User</h2>
                </div>
                <div class="card-body chat-messages">
                    Choose a user to chat
                </div>
                <div class="card-footer chat-input">
                    <input type="text" class="form-control" placeholder="Type your message...">
                    <button class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>
@endsection