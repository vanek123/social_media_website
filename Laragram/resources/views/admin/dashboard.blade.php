@extends('layouts.admin')

@section('content')

    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        
        <img src="{{auth()->user()->profile->profileImage()}}" alt="">
    </div>
    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Dashboard</span>
            </div>
            <div class="boxes">
                <div class="box box1">
                    <i class="uil uil-user"></i>
                    <span class="text">Total Users</span>
                    <span class="number">{{ $totalUsers }}</span>
                </div>
                <div class="box box2">
                    <i class="uil uil-user-plus"></i>
                    <span class="text">New Users (30 Days)</span>
                    <span class="number">{{ $newUsers }}</span>
                </div>
                <div class="box box3">
                    <i class="uil uil-signin"></i>
                    <span class="text">Active Users (30 Days)</span>
                    <span class="number">{{ $activeUsers }}</span>
                </div>
                <div class="box box1">
                    <i class="uil uil-comments"></i>
                    <span class="text">Total Comments</span>
                    <span class="number">{{ $totalComments }}</span>
                </div>
                <div class="box box2">
                    <i class="uil uil-image"></i>
                    <span class="text">Total Posts</span>
                    <span class="number">{{ $totalPosts }}</span>
                </div>
                <div class="box box3">
                    <i class="uil uil-message"></i>
                    <span class="text">Total Messages</span>
                    <span class="number">{{ $totalMessages }}</span>
                </div>                
            </div>
            <div class="export-button">
                <a href="{{ route('admin.export_dashboard_pdf') }}" class="btn allBtn">Export as PDF</a>
            </div>
        </div>    
    </div>
    


@endsection