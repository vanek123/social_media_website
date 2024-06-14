<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Message;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $totalUsers = User::where('isAdmin', 0)->count();
        $totalComments = Comment::count();
        $totalPosts = Post::count();
        $totalMessages = Message::count();
        // Fetch new users in the last 30 days excluding admins
        $newUsers = User::where('isAdmin', 0)
                        ->where('created_at', '>=', Carbon::now()->subDays(30))
                        ->count();

        // Fetch active users in the last 30 days excluding admins
        $activeUsers = User::where('isAdmin', 0)
                           ->where('last_login_at', '>=', Carbon::now()->subDays(30))
                           ->count();
        // Logic to fetch data for the admin dashboard
        return view('admin.dashboard', compact('totalUsers', 'totalComments', 'totalPosts', 'newUsers', 'activeUsers', 'totalMessages'));
    }

    public function users()
    {
        $users = User::select('id', 'name', 'email', 'username', 'created_at', 'status')
                    ->where('isAdmin', '!=', 1)
                    ->get();

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

    public function exportUsersPdf()
    {
        // Fetch the users data
        $users = User::select('id', 'name', 'email', 'username', 'created_at', 'status')->where('isAdmin', '!=', 1)->get();

        // Load the view and pass the data
        $html = view('admin.users_pdf', compact('users'))->render();

        // Create an instance of mPDF
        $mpdf = new Mpdf();

        // Write the HTML content to the PDF
        $mpdf->WriteHTML($html);

        // Output the PDF as a download
        return $mpdf->Output('users.pdf', 'D');
    }

    public function exportDashboardPdf() 
    {
        // Fetch the dashboard statistics
    $totalUsers = User::where('isAdmin', 0)->count();
    $totalComments = Comment::count();
    $totalPosts = Post::count();
    $totalMessages = Message::count();
    $newUsers = User::where('isAdmin', 0)
                    ->where('created_at', '>=', Carbon::now()->subDays(30))
                    ->count();
    $activeUsers = User::where('isAdmin', 0)
                       ->where('updated_at', '>=', Carbon::now()->subDays(30))
                       ->count();

    // Generate HTML for the PDF content
    $html = view('admin.dashboard_pdf', compact('totalUsers', 'totalComments', 'totalPosts', 'newUsers', 'activeUsers', 'totalMessages'))->render();

    // Initialize mPDF instance
    $mpdf = new Mpdf();

    // Write HTML content to PDF
    $mpdf->WriteHTML($html);

    // Output PDF as download
    $mpdf->Output('dashboard_statistics.pdf', 'D');
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
}
