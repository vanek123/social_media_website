@extends('layouts.app')

@section('content')
<!--<div class="container bg-white rounded border">
    @foreach($posts as $post)

    <div class="row pt-3">
        <div class="col-6 offset-3">
            <a href="/profile/{{ $post->user->profile->id }}">
                <img src="{{ $post->user->profile->profileImage() }}" alt="" class="rounded-circle w-100" style="max-width: 80px;">
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->media }}" alt="" class="w-100">
            </a>
        </div>
    </div>
    <div class="row pt-2 pb-4">
        <div class="col-6 offset-3 py-2">

            <hr>

            <p>
                <span class="fw-bold">
                     <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username}}</span>
                    </a> 
                </span> {{ $post->caption }}
            </p>

            <hr>

            @foreach($post->comments as $comment)
            <p>    
                <span class="fw-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $comment->user->username}}</span>
                   </a> 
                </span>
                    {{ $comment->comment }}    
            </p>
            @endforeach
        </div>
    </div>
    
        

        
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>-->

<div>
    <div class="container d-flex justify-content-center p-0">
        <h4 class="text-light"><strong>YOUR FEED</strong></h4>
    </div>
    
    <div class="container p-0">
        <hr class="mt-2 mb-4">
    </div>
    <div class="container d-flex justify-content-center posts">
        <div class="cont rounded m-0 p-0">
            @foreach($posts as $post)
        
            <div class="row pt-3 ps-4">
                <div class="row">
                    <a href="/profile/{{ $post->user->profile->id }}">
                        <img src="{{ $post->user->profile->profileImage() }}" alt="" class="rounded-circle w-100" style="max-width: 80px;">
                        <span class="fw-bold ps-4">{{ $post->user->username}}</span>
                    </a>
                </div>
            </div>
        
            <div class="row mx-0 p-0">
                <div class="row pt-2 m-0">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->media }}" alt="" class="img-fluid">
                    </a>
                </div>
            </div>
        
            <div class="row pt-2 ps-4">
                
                <div class="col-6 py-2 text-light">
        
                    <p class="mb-2">
                        <span class="fw-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span>{{ $post->user->username}}</span>
                            </a> 
                        </span> {{ $post->caption }}
                    </p>
        
                    @if($post->comments->count() > 0)
                        <p>
                            <a href="{{ route("posts.show", [$post, $comment->id]) }}">See all comments ({{ $post->comments->count() }})</a>
                        </p>
                    @endif
        
                </div>
            @endforeach
        
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

@endsection
