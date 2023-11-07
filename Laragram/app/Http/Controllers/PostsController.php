<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user', 'comments')->latest()->simplePaginate(5);

        return view('posts.index', compact('posts'));
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

    public function destroy($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $userId = $post->user->id;

        $post->delete();

        return redirect()->route("profile.show", ['user' => $userId])->with("success", "Post deleted successfully!");
    }

    public function show(\App\Models\Post $post, User $user) 
    {
        return view('posts.show', compact('post', 'user'));
    }
}
