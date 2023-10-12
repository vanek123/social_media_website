@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <div class="d-flex justify-content-center align-items-center">
                <img src="https://twtv3.ams3.digitaloceanspaces.com/posts/laravel-developer-tips.png" class="profile-image rounded-circle">
            </div> 
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1> {{ $user->username }} </h1>
                <a href="#">Add New Post</a>
            </div>
            <div class="d-flex">
                <div class=""><strong>153</strong> posts</div>
                <div class="ps-5"><strong>23k</strong> followers</div>
                <div class="ps-5"><strong>212</strong> following</div>
            </div>
            <div class="pt-4 fw-bold">{{ $user->profile->title ?? '' }}</div>
            <div>{{ $user->profile->description ?? '' }}</div>
                <div><a href="#">{{ $user->profile->url ?? '' }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-4">
            <img src="https://buffer.com/cdn-cgi/image/w=7000,fit=contain,q=90,f=auto/library/content/images/2023/09/instagram-image-size.jpg" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://buffer.com/cdn-cgi/image/w=7000,fit=contain,q=90,f=auto/library/content/images/2023/09/instagram-image-size.jpg" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://buffer.com/cdn-cgi/image/w=7000,fit=contain,q=90,f=auto/library/content/images/2023/09/instagram-image-size.jpg" class="w-100">
        </div>
    </div>
</div>
@endsection
