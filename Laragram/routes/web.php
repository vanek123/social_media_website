<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::post('p/{post}/comments', 'App\Http\Controllers\CommentsController@store')->name('posts.comments.store');
Route::delete('p/{post}/comments/{id}', 'App\Http\Controllers\CommentsController@destroy')->name('posts.comments.destroy');

Route::post('follow/{user}', 'App\Http\Controllers\FollowsController@store')->name('profile.follow');

Route::get('/', 'App\Http\Controllers\PostsController@index')->name('posts.index');
Route::get('/p/create', 'App\Http\Controllers\PostsController@create');
Route::post('/p', 'App\Http\Controllers\PostsController@store')->name('posts.store');
Route::get('/p/{post}', 'App\Http\Controllers\PostsController@show')->name('posts.show');
Route::delete('/p/{post}', 'App\Http\Controllers\PostsController@destroy')->name('posts.destroy');

Route::get('/search', 'App\Http\Controllers\ProfilesController@search')->name('profile.search');
Route::get('/allUsers', 'App\Http\Controllers\ProfilesController@allUsers');
Route::get('/search/{query}', 'App\Http\Controllers\ProfilesController@find')->name('profile.find');
Route::get('/profile/{user}', 'App\Http\Controllers\ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update');


//Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');
//Route::get('/users', 'App\Http\Controllers\AdminController@users')->name('admin.users');
//Route::get('/users/status/{user_id}/{status_code}', 'App\Http\Controllers\AdminController@updateStatus');

Route::middleware('auth')->group(function(){
    Route::resource('users', App\Http\Controllers\AdminController::class);

    Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');
    Route::get('/users', 'App\Http\Controllers\AdminController@users')->name('admin.users');
    Route::get('/users/status/{user_id}/{status_code}', 'App\Http\Controllers\AdminController@updateStatus')->name('users.status.update');
});

Route::middleware(['auth', 'verified'])->get('/chats', [ChatController::class, 'index'])->name('chats');
Route::middleware(['auth', 'verified'])->get('/chat/{id}', [ChatController::class, 'chatWithUser'])->name('chatWithUser');
Route::middleware(['auth', 'verified'])->post('/send_message', [ChatController::class, 'send_message'])->name('chat.send_message');
Route::middleware(['auth', 'verified'])->post('/refresh_messages', [ChatController::class, 'refresh_messages'])->name('refresh_messages');