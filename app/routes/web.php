<?php

use App\Livewire\Posts\PostList;
use Illuminate\Support\Facades\Route;

Route::get('/',fn()=>"")->name('home');
Route::get('/posts',PostList::class)->name('posts');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
