<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotspotController;
use App\Http\Controllers\PPPoEController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UseractiveController;
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
    return view('auth.login');
});

Route::get('/failed', function () {
    return view('failed');
});


// Auth Login & Logout
Route::get('login', [AuthController::class, 'index'])->name('auth.index');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Fitur PPPoE
Route::get('pppoe/secret', [PPPoEController::class, 'secret'])->name('pppoe.secret');
Route::get('pppoe/secret/active', [PPPoEController::class, 'active'])->name('pppoe.active');
Route::post('pppoe/secret/add', [PPPoEController::class, 'add'])->name('pppoe.add');
Route::get('pppoe/secret/edit/{id}', [PPPoEController::class, 'edit'])->name('pppoe.edit');
Route::post('pppoe/secret/update', [PPPoEController::class, 'update'])->name('pppoe.update');
Route::get('pppoe/secret/delete/{id}', [PPPoEController::class, 'delete'])->name('pppoe.delete');

// Fitur Hotspot
Route::get('hotspot/users', [HotspotController::class, 'users'])->name('hotspot.users');
Route::get('hotspot/users/active', [HotspotController::class, 'active'])->name('hotspot.active');
Route::post('hotspot/users/add', [HotspotController::class, 'add'])->name('hotspot.add');
Route::get('hotspot/users/edit/{id}', [HotspotController::class, 'edit'])->name('hotspot.edit');
Route::post('hotspot/users/update', [HotspotController::class, 'update'])->name('hotspot.update');
Route::get('hotspot/users/delete/{id}', [HotspotController::class, 'delete'])->name('hotspot.delete');

// Realtime
Route::get('dashboard/cpu', [DashboardController::class, 'cpu'])->name('dashboard.cpu');
Route::get('dashboard/load', [DashboardController::class, 'load'])->name('dashboard.load');
Route::get('dashboard/uptime', [DashboardController::class, 'uptime'])->name('dashboard.uptime');
Route::get('dashboard/traffic/{interface}', [DashboardController::class, 'traffic'])->name('dashboard.traffic');

// Report Traffic UP & Search
Route::get('report-up', [ReportController::class, 'index'])->name('report-up.index');
Route::get('report-up/load', [ReportController::class, 'load'])->name('report-up.load');
Route::get('report-up/search', [ReportController::class, 'search'])->name('search.report');

// User Active Mikrotik
Route::get('useractive', [UseractiveController::class, 'index'])->name('user.index');
Route::get('realtime/useractive', [UseractiveController::class, 'useractive'])->name('realtime.useractive');

// Store Data Up & Down
Route::get('/up', [ReportController::class, 'up']);
Route::get('/down', [ReportController::class, 'down']);



