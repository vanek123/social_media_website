<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        if ($user->isAdmin) {
            abort(404); // Return a 404 Not Found response
        }

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember('count.posts.' . $user->id, 
        now()->addSeconds(5), 
        function () use ($user) {
            return $user->posts->count();
        });

        $followersCount = Cache::remember('count.followers.' . $user->id, 
        now()->addSeconds(5), 
        function () use ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember('count.following.' . $user->id, 
        now()->addSeconds(5), 
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
    
    public function find($query) 
    {
        $currentUserId = auth()->id();
        $users = User::where('username', 'like', "%$query%")
                    ->where('id', '!=', $currentUserId) // Exclude the logged-in user
                    ->where('isAdmin', false)
                    ->with('profile')->get();
        $usersWithProfileImage = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'media' => $user->profile->profileImage(),
            ];
        });
        return response()->json($usersWithProfileImage);
    }

    public function allUsers() {
        $currentUserId = auth()->id();
        $users = User::where('id', '!=', $currentUserId) // Exclude the logged-in user
                    ->where('isAdmin', false)
                    ->with('profile')->get();
        $usersWithProfileImage = $users->map(function ($user) {
            $profileImage = $user->profile ? $user->profile->profileImage() : null;
            return [
                'id' => $user->id,
                'username' => $user->username,
                'media' => $profileImage,
            ];
        });
        return response()->json($usersWithProfileImage);
    }

    /*public function find(Request $request)
    {

        if ($request->ajax()) {
        $data = User::where('username', 'LIKE', '%' . $request->search . '%')->get();

        $output = '';

        if (count($data) > 0) {
            $output = '<div class="row">';

            foreach ($data as $row) {
                $output .= '<div class="col-md-4 mt-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <a href="/profile/' . $row->id . '">
                                            <img src="' . $row->profile->profileImage() . '" class="rounded-circle mb-3" style="max-width: 60px;">
                                        </a>
                                        <h5 class="card-title">
                                            <a href="' . route('profile.show', ['user' => $row->id]) . '">
                                                ' . $row->username . '
                                            </a>
                                        </h5>
                                        <a href="' . route('profile.follow', ['user' => $row->id]) . '" class="btn btn-primary btn-sm">Follow</a>
                                        <a href="" class="btn btn-secondary btn-sm">Message</a>
                                    </div>
                                </div>
                            </div>';
            }

            $output .= '</div>';
        } else {
            $output .= "No Results Found";
        }

        return $output;
        }
    }*/

}


