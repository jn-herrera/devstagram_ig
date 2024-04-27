<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;


// main wall
Route::get('/', HomeController::class)->name('home');

//register
Route::get('/register',[RegisterController::class, 'index'])->name('register'); //add user
Route::post('/register',[RegisterController::class, 'store'] ); // save user 

//loggin
Route::get('/login',[LoginController::class, 'index'])->name('login'); //loggin 
Route::post('/login',[LoginController::class, 'store']); // save user log
Route::post('/logout',[LogoutController::class, 'store'])->name('logout'); //logout

//profile routes
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

//posts
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); //save posts
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show'); //show posts
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); //delete post

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store'); //save comments

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Like at photos
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index'); //wall posts
//Save followers

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');