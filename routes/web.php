<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PollController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

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
Route::middleware([CheckAuth::class])->group(function(){
    // ------------------ Dashboard Cntroller -------------

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/admin-logout', [DashboardController::class, 'adminLogout']);

    // ----------------- Add Poll -------------------
    Route::get('/add-poll', [PollController::class, 'addPoll']);
    Route::post('/save-poll', [PollController::class, 'savePoll']);
    Route::get('/list-poll', [PollController::class, 'listPoll']);
});



// --------------- AdminLogin Controller --------------

Route::get('/admin-login', [AdminLoginController::class, 'adminLogin']);
Route::post('/check-auth', [AdminLoginController::class, 'checkAuth']);

// ------------------------- FrontEnd ------------------
// ----------------------- IndexController --------------
Route::get('/', [HomeController::class, 'home']);