<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Controller Route Start
Route::get('/home',[AdminController::class,'index'])->name('admin');
// Admin Controller Route End


// Teacher Controller Route Start
Route::get('/teacher',[TeacherController::class,'index'])->name('teacher');
// Teacher Controller Route End

// Parents Controller Route Start
Route::get('/parent',[ParentsController::class,'index'])->name('parents');
// Parents Controller Route End

// Student Controller Route Start
Route::get('/student',[StudentController::class,'index'])->name('student');
// Student Controller Route End
