@extends('layouts.app')

@section('content')
<div class="container posts">
    <div class="row">
        <div class="col-8 p-0">
            <img src="/storage/{{ $post->media }}" class="object-fit-cover w-100">
        </div>
        <div class="col-4 d-flex flex-column shadow p-3 rounded-right border-light">
            <div class="d-flex align-items-center">
                <div class="pe-3">
                    <a href="/profile/{{ $post->user->id }}"><img src="{{ $post->user->profile->profileImage() }}" alt="" class="rounded-circle w-100" style="max-width: 40px;"></a>
                </div>
                <div>
                    <div class="fw-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-white">{{ $post->user->username}}</span>
                        </a>
                        <!--<a href="" class="follow-link ps-3">Follow</a>-->
                    </div>
                </div>
            </div>

            <hr>

            <div class="">
                <p class="m-0 text-white">
                <span class="fw-bold ">
                     <a href="/profile/{{ $post->user->id }}">
                        <span class="text-white">{{ $post->user->username}}</span>
                    </a> 
                </span> {{ $post->caption }}
                </p> 
            </div>

            <hr>
            
            @foreach($post->comments as $comment)
                <div class="d-flex align-items-center">
                    <small class="fs-6 fw-light text-white">{{ $comment->created_at->format('Y-m-d H:i:s') }}</small>
                    @if(Auth::check() && Auth::user()->id == $comment->user->id)
                        <form action="{{ route("posts.comments.destroy", [$post, $comment->id]) }}" method="post">
                            @csrf
                            @method("delete")
                                <button class="btn btn-danger btn-sm p-1 ms-2">Delete</button>
                        </form>
                    @endif
                </div>
            <p class="text-white">    
                <span class="fw-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-white">{{ $comment->user->username}}</span>
                   </a> 
                </span>
                    {{ $comment->comment }}    
            </p>
            @endforeach

            <form action="{{ route("posts.comments.store", $post->id) }}" method="post" class="mt-auto">
                @csrf
                <div class="form-group mt-auto">
                    <textarea name="comment" class="form-control mb-2" placeholder="Leave a comment"></textarea>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                </div>
            </form>
            
            @if(Auth::check() && Auth::user()->id == $post->user->id)
                <form action="{{ route("posts.destroy", $post->id) }}" method="post" class="mt-2">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete Post</button>
                </form>
            @endif

        </div>   

    </div>
</div>

@endsection
