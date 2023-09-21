<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherAttachmentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Teacher;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('teachers', TeacherController::class);

Route::resource('schools', SchoolController::class);

Route::resource('users', UserController::class);

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/create', [UserController::class, 'create'])->name('create_user');

Route::post('/store', [UserController::class, 'store'])->name('store_user');

Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit_user');

Route::get('/update/{id}', [UserController::class, 'update'])->name('update_user');

//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', 'Auth\LoginController@login');


Route::get('/', function () {
    return view('welcome');
});


