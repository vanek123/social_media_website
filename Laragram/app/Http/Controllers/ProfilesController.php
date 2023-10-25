<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', compact('user', 'follows'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'media' => 'mimetypes:image/jpeg,image/png',
        ]);

        if (request('media')) 
        {
            $mediaPath = request('media')->store('profile', 'public');

            $media = Image::make(public_path("storage/{$mediaPath}"))->fit(1000, 1000);
            $media->save();

            $mediaArray = ['media' => $mediaPath];
        }
        
        auth()->user()->profile->update(array_merge(
            $data,
            $mediaArray ?? [],
        ));

        return redirect("/profile/{$user->id}");
    }

}

