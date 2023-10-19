<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        $imagePath = request('media')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'media' => $imagePath,
        ]);

        return redirect('/profile/'. auth()->user()->id);
    }
}
