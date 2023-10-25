<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'media' => ['required', 'mimetypes:image/jpeg,image/png,video/mp4,video/mpeg,video/quicktime'],
        ]);

        $mediaPath = request('media')->store('uploads', 'public');

        $media = Image::make(public_path("storage/{$mediaPath}"))->fit(1200, 1200);
        $media->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'media' => $mediaPath,
        ]);

        return redirect('/profile/'. auth()->user()->id);
    }

    public function show(\App\Models\Post $post) 
    {
        return view('posts.show', compact('post'));
    }
}
