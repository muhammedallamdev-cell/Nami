<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController;

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

//  ========================================== Default Redirect ==========================================
Route::get('/', function () {
    return Auth::guard('admin')->check() 
    ? redirect()->route('admin.dashboard') 
    : redirect()->route('admin.auth.login.form');
})->name('home')->middleware('admin.sanctum');

//  ========================================== Admin Auth Routes ==========================================
Route::get('/auth/login', function () { 
    return view('admin.auth.login');
 })->name('admin.auth.login.form');

 Route::get('/auth/logout', [AuthAdminController::class, 'logout'])->name('admin.auth.logout');

Route::post('/auth/set-token', [AuthAdminController::class, 'setToken'])->name('admin.auth.setToken');

Route::middleware('admin.sanctum','verified')->get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
