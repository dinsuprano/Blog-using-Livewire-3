<?php

use App\Livewire\CreatePost;
use App\Livewire\ShowPosts;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-post', CreatePost::class);

Route::get('/posts', ShowPosts::class);