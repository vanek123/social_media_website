@extends('layouts.app')

@section('content')
<div class="container">
    <!-- User Profile Section -->
    <div class="row rounded" style="background-color: #1E1E24">
        @if(!$user->isAdmin)
        <!-- Profile Image and Information -->
        <div class="col-md-3 pt-4 pb-4">
            <div class="d-flex justify-content-center">
                <img src="{{ $user->profile->profileImage() }}" alt="Profile Image" class="profile-image rounded-circle img-fluid">
            </div>
        </div>

        <!-- Profile Stats and Description -->

        <div class="col-md-9 pt-4 text-light">
            
            <div class="d-flex align-items-center pb-3">
                <div class="h4">{{ $user->username }}</div>
                @if(Auth::check() && Auth::user()->id !== $user->id)
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @endif

                @can('update', $user->profile)
                    <a href="/p/create"><button class="btn allBtn ms-4">Add New Post</button></a>
                @endcan 

                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit"><button class="btn allBtn ms-4">Edit Profile</button></a>
                @endcan
            </div> 

            <div class="d-flex align-items-baseline">
                <div class="pe-3"><strong class=>{{ $postCount }}</strong> posts</div>
                <div class="pe-3"><strong>{{ $followersCount }}</strong> followers</div> 
                <div><strong>{{ $followingCount }}</strong> following</div>
            </div>
            
            <div class="">
                <div class="fw-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div><a href="#">{{ $user->profile->url }}</a></div>
            </div>
            
        </div>
    </div>

    <!-- User Posts Section -->
    <div class="row mt-3 rounded" style="background-color: #1E1E24">
        <div class="col-md-12 pt-4">
            <h4 class="fw-bold text-light text-center">POSTS</h4>
            <hr class="text-light">
        </div>
        @if($user->posts->isEmpty())
            <div class="col-md-12 text-light text-center">
                @if(Auth::check() && Auth::user()->id === $user->id)
                    <p>You don't have any posts yet.</p>
                @else
                    <p>This user doesn't have any posts yet.</p>
                @endif
            </div>
        @else
            @foreach($user->posts as $post)
                <div class="col-md-4 pb-4">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->media }}" alt="Post Image" class="w-100 shadow-sm rounded">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    @endif
</div>
@endsection