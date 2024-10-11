<?php

use App\Livewire\CreatePost;
use App\Livewire\EditPost;
use App\Livewire\ListPosts;
use App\Livewire\ManagePosts;
use App\Livewire\SinglePost;
use Illuminate\Support\Facades\Route;


//Fronted
Route::get('/', ListPosts::class)->name('landing.page');
Route::get('/post/{postId}', SinglePost::class)->name('single.post');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Fronted
Route::get('/', ListPosts::class)->name('landing.page');
Route::get('/post/{postId}', SinglePost::class)->name('single.post');

// Backend routes
Route::middleware(['role:admin'])->group(function () {
    Route::get('/create-post', CreatePost::class);
    Route::get('/manage-posts', ManagePosts::class)->name('manage.posts');
    Route::get('/post/{postId}/edit', EditPost::class)->name('edit.post');
});