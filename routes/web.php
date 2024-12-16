<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/comments/moderate', [CommentController::class, 'moderate'])->name('comments.moderate');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts/{post}/toggle-publish', [PostController::class, 'togglePublish'])->name('posts.toggle-publish');
Route::get('/posts/unpublished', [PostController::class, 'unpublished'])->name('posts.unpublished');
Route::post('/posts/{post}/unpublish', [PostController::class, 'toggleUnpublish'])->name('posts.toggleUnpublish');
Route::get('/posts', [PostController::class, 'published'])->name('posts.published');
Route::resource('posts', PostController::class);
Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::patch('/posts/{post}/toggle-publish', [\App\Http\Controllers\PostController::class, 'togglePublish'])
    ->name('posts.toggle-publish');
Route::get('/publish-posts', [PostController::class, 'publishPosts'])->name('posts.publish');
Route::post('/posts/{post}/toggle-publish', [PostController::class, 'togglePublish'])
    ->name('posts.togglePublish');
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::patch('comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
Route::resource('posts', PostController::class);
Route::get('/', function () {
    return view('welcome');
});
