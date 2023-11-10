<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'welcome'])->name('welcome');
Route::get('/kitcat/{id}/show',[HomeController::class,'show'])->name('kitcat.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::name('admin.')->group(function(){
        // Admin HomePage
        Route::get('/home',[AdminController::class,'home'])->name('home');
        // Categories Routes
        Route::resource('/categories', CategoryController::class);
        Route::get('/cat/trashed',[CategoryController::class,'trashed'])->name('categories.trashed');
        Route::get('/cat/{id}/restore',[CategoryController::class,'retrieve'])->name('categories.restore');
        Route::get('/cat/{id}/remove',[CategoryController::class,'remove'])->name('categories.remove');

        // Posts Routes
        Route::get('posts/index',[PostController::class,'index'])->name('posts.index');
        Route::get('posts/trashed',[PostController::class,'trashed_posts'])->name('posts.trashed');
        Route::get('posts/create',[PostController::class,'create'])->name('posts.create');
        Route::post('posts/store',[PostController::class,'store'])->name('posts.store');
        Route::get('posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
        Route::post('posts/{id}/update',[PostController::class,'update'])->name('posts.update');
        Route::get('posts/{id}/destroy',[PostController::class,'destroy'])->name('posts.destroy');
        Route::get('posts/search',[PostController::class,'search'])->name('posts.search');
        Route::post('posts/search',[PostController::class,'search'])->name('posts.search');

        Route::get('/trashed_posts/{id}/restore',[PostController::class,'restore'])->name('trashed_posts.restore');
        Route::get('/trashed_posts/{id}/remove',[PostController::class,'remove'])->name('trashed_posts.remove');

        // Users Routes
        Route::get('/users/index',[UserController::class,'index'])->name('users.index');
        Route::get('/users/{id}/promote',[UserController::class,'promote'])->name('users.promote');
        Route::get('/users/{id}/destroy',[UserController::class,'destroy'])->name('users.destroy');
        Route::get('/users/profile',[UserController::class,'profile'])->name('users.profile');
        Route::get('/users/{id}/user_profile',[UserController::class,'user_profile'])->name('users.user_profile');
        Route::post('/users/{id}/profile/update',[UserController::class,'update'])->name('users.update');
        Route::get('/users/{id}/demote',[UserController::class,'demote'])->name('users.demote');
        Route::get('/users/trashed',[UserController::class,'trashed_users'])->name('users.trashed');
        Route::get('/trashed_users/{id}/restore',[UserController::class,'restore'])->name('trashed_users.restore');
        Route::get('/trashed_users/{id}/remove',[UserController::class,'remove'])->name('trashed_users.remove');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
