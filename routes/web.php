<?php

use App\Http\Controllers\AuthController;
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
/******************LOGIN PAGE ROUTES START****************/
Route::view('/', 'auth.login')->name('user.login');
Route::view('login', 'auth.login')->name('auth.login');
Route::post('login',[AuthController::class,'login'])->name('user.login');
/******************LOGIN PAGE ROUTES END****************/
/******************MIDDLEWARE PAGES ROUTES START****************/
Route::group(['middleware' => 'auth:web'], function () { 
    /*******************LOGOUT ROUTE START*************/       
    Route::get('logout',[AuthController::class,'logout'])->name('user.logout');
    /*******************LOGOUT ROUTE END*************/       
    /*******************TASK ROUTE START*************/   
    Route::view('tasks', 'task.index')->name('task.index');
    Route::view('task/create', 'task.create')->name('task.create');
    /*******************TASK ROUTE END*************/   
});
/******************MIDDLEWARE PAGES ROUTES END****************/