@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->media }}" class="w-100">
        </div>
        <div class="col-4 d-flex flex-column">
            <div class="align-items-center justify-content-center">
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

            <div>
                <p>
                <span class="fw-bold">
                     <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username}}</span>
                    </a> 
                </span> {{ $post->caption }}
                </p> 
            </div>
            
            @foreach($post->comments as $comment )
                <small class="fs-6 fw-light text-muted">{{ $comment->created_at }}</small>
            <p>    
                <span class="fw-bold">
                    <a href="/profile/{{ $post->user->id }}">
                       <span class="text-dark">{{ $comment->user->username}}</span>
                   </a> 
               </span> {{ $comment->comment }}
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
