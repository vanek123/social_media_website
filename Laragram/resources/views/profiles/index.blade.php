@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ $user->profile->profileImage() }}" class="profile-image rounded-circle img-fluid">
            </div> 
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>
                    
                    @if(Auth::check() && Auth::user()->id !== $user->id)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endif
                </div>
                
                    @can('update', $user->profile)
                        <a href="/p/create"><button class="btn btn-primary">Add New Post</button></a>
                    @endcan    
                    
            </div>
                <div class="pb-3">
                    @can('update', $user->profile)
                        <a href="/profile/{{ $user->id }}/edit"><button class="btn btn-primary">Edit Profile</button></a>
                    @endcan
                </div>
                    
            
            <div class="d-flex">
                <div class=""><strong>{{ $postCount }}</strong> posts</div>
                <div class="ps-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="ps-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 fw-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
                <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->media }}" class="w-100 shadow-lg">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
