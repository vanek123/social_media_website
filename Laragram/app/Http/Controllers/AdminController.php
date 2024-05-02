<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Logic to fetch data for the admin dashboard
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::select('id', 'name', 'email', 'username', 'created_at', 'status')->get();

        return view('admin.users')->with([
            'users' => $users
        ]);
    }

    /**
     *To update status of user (ban/unban)
     * @param Integer $user_id
     * @param Integer $status_code 
     * @return Success Response.
     */ 

    public function updateStatus($user_id, $status_code) 
    {
        try {
            $update_user = User::whereId($user_id)->update([
                'status' => $status_code
            ]);

            if($update_user) {
                return redirect()->route('admin.users')->with('success', 'User Status Updated 
                Successfully.');
            }

            return redirect()->route('admin.users')->with('error', 'Failed to update user status.');
            
        }
        catch(\Throwable $th) {
            throw $th;
        }
    }
}
