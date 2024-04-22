<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Logic to fetch data for the admin dashboard
        return view('admin.dashboard');
    }
}
