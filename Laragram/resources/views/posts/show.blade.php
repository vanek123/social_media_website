@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 p-0">
            <img src="/storage/{{ $post->media }}" class="w-100">
        </div>
        <div class="col-4 d-flex flex-column shadow p-3 rounded-right border-light">
            <div class="d-flex align-items-center">
                <div class="pe-3">
                    <img src="{{ $post->user->profile->profileImage() }}" alt="" class="rounded-circle w-100" style="max-width: 40px;">
                </div>
                <div>
                    <div class="fw-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username}}</span>
                        </a>
                        <a href="" class="follow-link ps-3">Follow</a> 
                    </div>
                </div>
            </div>

            <hr>

            <div class="">
                <p class="m-0">
                <span class="fw-bold ">
                     <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username}}</span>
                    </a> 
                </span> {{ $post->caption }}
                </p> 
            </div>

            <hr>
            
            @foreach($post->comments as $comment)
                <div class="d-flex align-items-center">
                    <small class="fs-6 fw-light text-muted">{{ $comment->created_at }}</small>
                    @if(Auth::check() && Auth::user()->id == $comment->user->id)
                        <form action="{{ route("posts.comments.destroy", [$post, $comment->id]) }}" method="post">
                            @csrf
                            @method("delete")
                                <button class="btn btn-danger btn-sm p-0 ms-1">Delete</button>
                        </form>
                    @endif
                </div>
            <p>    
                <span class="fw-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $comment->user->username}}</span>
                   </a> 
                </span>
                    {{ $comment->comment }}    
            </p>
            @endforeach

            <form action="{{ route("posts.comments.store", $post->id) }}" method="post" class="mt-auto">
                @csrf
                <div class="form-group mt-auto">
                    <textarea name="comment" class="form-control mb-2" placeholder="Leave a comment"></textarea>
                    <button type="submit" class="btn btn-primary ">Add Comment</button>
                </div>
                
            </form>
            
        </div>

            

    </div>
</div>

@endsection
