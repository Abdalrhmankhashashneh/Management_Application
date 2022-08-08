<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserControler;
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

Route::get('/', [AdminController::class , 'index' ])->middleware('isLogedIn');

Route::get('/dashboard', [AdminController::class , 'index' ])->name('dashboard')->middleware('isLogedIn');
Route::get('/admin/vacation', [AdminController::class , 'vacation_request' ])->name('vacation')->middleware('isLogedIn');
Route::post('/admin/vacation/request', [AdminController::class , 'vacation_request_action' ])->name('vacation_req')->middleware('isLogedIn');
Route::get('/admin/vacation/offusers', [AdminController::class , 'offusers' ])->name('offusers')->middleware('isLogedIn');

Route::get('/login', [ Login::class, 'login' ]);
Route::post('/login_check', [ Login::class, 'login_check' ])->name('login_check');
Route::get('/logout' , [Login::class , 'logout'])->name('logout');

// **************************** users ****************************
Route::get('/admin/user/create' , [AdminController::class , 'create_user'])->name('create_user')->middleware('isLogedIn');
Route::post('/admin/user/add' , [AdminController::class , 'add_user'])->name('add_user')->middleware('isLogedIn');
Route::get('/admin/user/edit/{id}' , [AdminController::class , 'edit_user'])->name('edit_user')->middleware('isLogedIn');
Route::put('/admin/user/update/{id}' , [AdminController::class , 'update_user'])->name('update_user')->middleware('isLogedIn');
Route::delete('/admin/user/delete/{id}' , [AdminController::class , 'delete_user'])->name('delete_user')->middleware('isLogedIn');
// **************************** users ****************************

// **************************** vacations ****************************
Route::get('/admin/vacation/create' , [AdminController::class , 'create_vacation'])->name('create_vacation')->middleware('isLogedIn');
Route::get('/admin/vacation/edit/{id}' , [AdminController::class , 'edit_vacation'])->name('edit_vacation')->middleware('isLogedIn');
Route::put('/admin/vacation/update/{id}' , [AdminController::class , 'update_vacation'])->name('update_vacation')->middleware('isLogedIn');
Route::post('/admin/vacation/add' , [AdminController::class , 'add_vacation'])->name('add_vacation')->middleware('isLogedIn');
Route::delete('/admin/vacation/delete/{id}' , [AdminController::class , 'delete_vacation'])->name('delete_vacation')->middleware('isLogedIn');
Route::get('/user/vacation/create' , [AdminController::class , 'request_vacation'])->name('request_vacation')->middleware('isLogedIn');
Route::post('/user/vacation/add' , [AdminController::class , 'add_request'])->name('add_request')->middleware('isLogedIn');
// **************************** vacations ****************************

Route::get('/user/dashboard' , [UserControler::class , 'index'])->name('user_dashboard')->middleware('isLogedIn');
