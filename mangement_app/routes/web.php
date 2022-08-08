<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\AdminController;
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

Route::get('/login', [ Login::class, 'login' ]);
Route::post('/login_check', [ Login::class, 'login_check' ])->name('login_check');
Route::get('/logout' , [Login::class , 'logout'])->name('logout');
