<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostCommentController;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('/posts/{post:slug}/comments', [PostCommentController::class, 'store']);

Route::middleware('can:admin')->group(function () {
    Route::resource('/admin/posts', AdminPostController::class)->except('show');
});



// pip install mysql
// mysql -uroot -p 
// create database blog;
// php artisan migrate

//             INSERT INTO `posts` (`id`, `slug` ,`title`, `excerpt`, `body`, `created_at`, `updated_at`, `published_at`) VALUES (1, 'my-first-post', 'My First Post', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, placeat ratione optio velit dolore quos blanditiis', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, placeat ratione optio velit dolore quos blanditiis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente possimus iste deleniti temporibus soluta quaerat labore ex non! Ad est enim cupiditate dolorum quas sint excepturi labore quos, aperiam illum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, placeat ratione optio velit dolore quos blanditiis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente possimus iste deleniti temporibus soluta quaerat labore ex non! Ad est enim cupiditate dolorum quas sint excepturi labore quos, aperiam illum?</p>', '2023-03-21 04:03:28', '2023-03-21 04:12:25', NULL);