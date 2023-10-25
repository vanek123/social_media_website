@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/profile/{{ $post->user->id }}">
                <img src="/storage/{{ $post->media }}" alt="" class="w-100">
            </a>
        </div>
    </div>
    <div class="row pt-2 pb-4"></div>
        <div class="col-6 offset-3 py-4">

            <hr>

            <p>
                <span class="fw-bold">
                     <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username}}</span>
                    </a> 
                </span> {{ $post->caption }}
            </p>
        </div>
    @endforeach
</div>

@endsection
