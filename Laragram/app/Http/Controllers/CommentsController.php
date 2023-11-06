<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class CommentsController extends Controller
{
    public function store(Post $post) 
    {
        $user = auth()->user();

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = $user->id;
        $comment->comment = request()->get('comment');
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('success', "Comment posted successfully!");
    }
}
