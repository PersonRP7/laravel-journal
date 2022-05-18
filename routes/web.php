<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('journal.home');
// });

Route::get('/', function () {
    return view('journal.home');
})->name('home');

Route::get('/see_all_users', [UserController::class, 'see_all_users']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/my_profile', [UserController::class, 'my_profile'])->
middleware(['auth'])->name('my_profile');

Route::get('/manage_users', [UserController::class, 'manage_users'])->
middleware(['auth'])->name('manage_users');

#Routes
Route::resource('roles', 'App\Http\Controllers\RoleController');

Route::resource('users', UserController::class);

Route::resource('posts', PostController::class);

// Route::get('posts/hello', [PostController::class, 'hello']);

require __DIR__.'/auth.php';
