<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;

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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');

Route::post('/post/store',[PostController::class,'store'])->name('post.store');

Route::get('/post/index',[PostController::class,'index'])->name('post.index');

Route::get('/post/show/{post}',[PostController::class,'show'])->name('post.show');

Route::get('/story',[PostController::class,'story'])->name('post.story');

Route::get('/contact',[PostController::class,'contact'])->name('post.contact');

Route::post('/post/send',[ContactController::class,'contact'])->name('post.send');

Route::get('/post/category/{category}/',[HomeController::class,'postsForCategory'])->name('post.category');

Route::get('/admin', [PostController::class,'admin'])->name('admin');

Route::get('/post/{post}/edit', [PostController::class,'edit'])->name('post.edit');

Route::post('/post/{post}/update', [PostController::class, 'update'])->name('post.update');

Route::post('/post/{id}/comments/', [PostController::class, 'addComment'])->name('post.comments');

Route::get('/thankyou',[ContactController::class,'thankyou'])->name('mail.thankyou');

Route::delete('/post/{post}/delete', [PostController::class, 'destroy'])->name('post.destroy');

Route::delete('/image/{image}/delete',[ImageController::class, 'destroy'])->name('image.destroy');

Route::delete('/comment/{comment}/delete',[CommentController::class, 'destroy'])->name('comment.destroy');