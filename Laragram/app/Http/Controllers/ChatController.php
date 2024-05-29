<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Profile;

class ChatController extends Controller
{
    public function index()
    {
        $authUser = auth()->user();
        $authUserUsername = $authUser->username;

        $messages = Message::select('message_sender', 'message_receiver')->where('message_sender', '=', auth()->user()->username)->orWhere('message_receiver', '=', auth()->user()->username)->get();

        $users_usernames = array();

        foreach ($messages as $message) {
            if ($message['message_sender'] != auth()->user()->username && !in_array($message['message_sender'], $users_usernames)) $users_usernames[] = $message['message_sender'];
            if ($message['message_receiver'] != auth()->user()->username && !in_array($message['message_receiver'], $users_usernames)) $users_usernames[] = $message['message_receiver'];
        }

        $users = User::whereIn('username', $users_usernames)->get();

        return view('chat.index', compact('users'));
    }


    public function chatWithUser($id = null)
    {
        $authUserUsername = auth()->user()->username;
        $selectedUser = null;
        $selectedUsername = null; // Initialize $selectedUsername
        $messages = collect();

        $authUserId = auth()->user()->id;
        $selectedUserId = $id;

        // Fetching images
        $authUserImage = Profile::select('media')->where('user_id', '=', $authUserId)->get()->toArray();
        $selectedUserImage = Profile::select('media')->where('user_id', '=', $selectedUserId)->get()->toArray();
        

        if ($selectedUserImage[0]['media'] == null) {
            $selectedUserImage = '/storage/profile/Wuslb5XmCz5F1cHQMHhHAlqEKXEhlJta1Uv0xDze.jpg';
        }
        else {
            $selectedUserImage = '/storage/' . $selectedUserImage[0]["media"];
        }

        if ($authUserImage[0]['media'] == null) {
            $authUserImage = '/storage/profile/Wuslb5XmCz5F1cHQMHhHAlqEKXEhlJta1Uv0xDze.jpg';
        }
        else {
            $authUserImage = '/storage/' . $authUserImage[0]["media"];
        }

    if ($id) {
        $selectedUser = User::findOrFail($id);
        $selectedUsername = User::select('username')->where('id', '=', $id)->pluck('username')->first();
        
        // Fetch messages with the selected user
        $messages = Message::where(function ($query) use ($authUserUsername, $selectedUsername) {
            $query->where('message_sender', $authUserUsername)
                  ->where('message_receiver', $selectedUsername);
        })->orWhere(function ($query) use ($authUserUsername, $selectedUsername) {
            $query->where('message_sender', $selectedUsername)
                  ->where('message_receiver', $authUserUsername);
        })->orderBy('created_at', 'asc')->get()->toArray();


    }

    // Fetch users with whom the authenticated user has had conversations
    $users = User::whereHas('sentMessages', function ($query) use ($authUserUsername) {
        $query->where('message_receiver', $authUserUsername);
    })->orWhereHas('receivedMessages', function ($query) use ($authUserUsername) {
        $query->where('message_sender', $authUserUsername);
    })->get();

    // Add the selected user to the users list if not already in the list
    if ($selectedUser && !$users->contains($selectedUser)) {
        $users->push($selectedUser);
    }

    return view('chat.chatWithUser', compact('selectedUser', 'selectedUsername', 'messages', 'users', 'authUserImage', 'selectedUserImage'));
    }   

    public function send_message(Request $request) {
        $authUserId = auth()->id();
        $selectedUser = User::findOrFail($authUserId);
        /*$profile = Profile::where('user_id', '=', $authUserId)->get();*/
        /*$user = User::where('username' , '=', $request['message_sender'])->get();*/

        $form_fields = $request->validate([
            'content' => 'required'
        ], [
            'content.required' => 'Message text is required'
        ]);
        $form_fields['message_sender'] = $request['message_sender'];
        $form_fields['message_receiver'] = $request['message_receiver'];
        $form_fields['status'] = 'UNREAD';
        Message::create($form_fields);

        $time = date("h:i A, d/m/Y", time());

        return response()->json([
            'name' => auth()->user()['username'],
            'image' => $selectedUser->profile->profileImage(),
            'content' => $request['content'],
            'time' => $time,
            'message_sender' => $request['message_sender']
        ]);
    }

    public function refresh_messages(Request $request) {
        $user = $request['user'];

        // mark unread messages as read when user opens the chat
        Message::where('message_sender', '=', $user)->where('message_receiver', '=', auth()->user()->username)->update(['status' => 'READ']);
        return response()->json();
    }
}
