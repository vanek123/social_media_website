<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember('count.posts.' . $user->id, 
        now()->addSeconds(30), 
        function () use ($user) {
            return $user->posts->count();
        });

        $followersCount = Cache::remember('count.followers.' . $user->id, 
        now()->addSeconds(30), 
        function () use ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember('count.following.' . $user->id, 
        now()->addSeconds(30), 
        function () use ($user) {
            return $user->following->count();
        });

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
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

    public function search() 
{
    return view('profiles.search');
}

    public function find(Request $request)
    {
        if($request->ajax()) {
            $data = User::where('username', 'LIKE', '%' .$request->search. '%')->get();

            $output = '';

            if(count($data) > 0) {
                $output = 
                '<div>';
                
                foreach($data as $row) {
                    $output .= '<div><a href="' . route('profile.show', ['user' => $row->id]) . '">' . $row->username . '</a></div>';
                }
                $output.= '
                </div>';
            } else {
                $output .= "No Results Found";
            }

            return $output;

        }
    }


}


