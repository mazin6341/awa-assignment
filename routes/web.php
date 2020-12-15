<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\PostController::class,'index'])->name('posts')->middleware('auth');

Route::post('createpost', [App\Http\Controllers\PostController::class,'store'])->name('post.create');
Route::get('deletepost/{id}', [App\Http\Controllers\PostController::class,'destroy'])->name('post.delete');
Route::get('showpost/{id}', [App\Http\Controllers\PostController::class,'show'])->name('post.show');
Route::post('editpostconfirm/', [App\Http\Controllers\PostController::class,'update'])->name('post.edit');

Route::post('createcomment', [App\Http\Controllers\CommentController::class,'store'])->name('comment.create');
Route::get('deletecomment/{id}', [App\Http\Controllers\CommentController::class,'destroy'])->name('comment.delete');
Route::get('showcomment/{id}', [App\Http\Controllers\CommentController::class,'show'])->name('comment.show');
Route::post('editcommentconfirm/', [App\Http\Controllers\CommentController::class,'update'])->name('comment.edit');
