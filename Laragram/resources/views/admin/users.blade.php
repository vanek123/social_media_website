@extends('layouts.admin')

@section('content')

    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Search here...">
        </div>
        
        <img src="{{auth()->user()->profile->profileImage()}}" alt="">
    </div>

    <div class="dash-content">
        <div class="activity">
            <div class="title">
                <i class="uil uil-users-alt"></i>
                <span class="text">Users</span>
            </div>
            <div class="activity-data">
                <div class="data names">
                    <span class="data-title">Name</span>
                    @foreach($users as $user)
                    <span class="data-list">{{$user->name}}</span>
                    @endforeach
                </div>
                <div class="data email">
                    <span class="data-title">Username</span>
                    @foreach($users as $user)
                    <span class="data-list">{{$user->username}}</span>
                    @endforeach
                </div>
                <div class="data joined">
                    <span class="data-title">Email</span>
                    @foreach($users as $user)
                    <span class="data-list">{{$user->email}}</span>
                    @endforeach
                </div>
                <div class="data type">
                    <span class="data-title">Joined</span>
                    @foreach($users as $user)
                    <span class="data-list">{{$user->created_at}}</span>
                    @endforeach
                </div>
                <div class="data status">
                    <span class="data-title">Status</span>
                    @foreach($users as $user)
                    @if($user->status == 1)
                    <span class="data-list">
                        <a href="{{ route('users.status.update', ['user_id' => $user->id, 'status_code' => 0])}}">Block</a>
                    </span>
                    @else
                    <span class="data-list">
                        <a href="{{ route('users.status.update', ['user_id' => $user->id, 'status_code' => 1])}}">Unblock</a>
                    </span>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection