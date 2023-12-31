<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::post('follow/{user}', 'App\Http\Controllers\FollowsController@store');

Route::get('/', 'App\Http\Controllers\PostsController@index')->name('posts.index');
Route::get('/p/create', 'App\Http\Controllers\PostsController@create');
Route::post('/p', 'App\Http\Controllers\PostsController@store')->name('posts.store');
Route::get('/p/{post}', 'App\Http\Controllers\PostsController@show')->name('posts.show');
Route::delete('/p/{post}', 'App\Http\Controllers\PostsController@destroy')->name('posts.destroy');

Route::get('/search', 'App\Http\Controllers\ProfilesController@search')->name('profile.search');
Route::get('/find', 'App\Http\Controllers\ProfilesController@find')->name('profile.find');
Route::get('/profile/{user}', 'App\Http\Controllers\ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update');


