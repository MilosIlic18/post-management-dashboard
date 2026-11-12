<?php

use App\Livewire\Dashboard;
use App\Livewire\Posts\PostGroupList;
use App\Livewire\Posts\PostList;
use Illuminate\Support\Facades\Route;

Route::get('/',Dashboard::class)->name('home');
Route::get('/posts',PostList::class)->name('posts');
Route::get('/group-posts',PostGroupList::class)->name('group-posts');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
