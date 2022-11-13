<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollAnswerController;
use App\Http\Controllers\AdminVottingController;
use App\Http\Controllers\VoterController;
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
    Route::post('/stop-poll', [PollController::class, 'stopPoll']);
    Route::post('/get-poll-result-admin', [PollController::class, 'getPollResultAdmin']);

    
    Route::get('/poll-details/{id}', [AdminVottingController::class, 'pollDetails']);


    // ------------------- Voter List ----------------------
    Route::get('/voter-list/', [VoterController::class, 'VoterList']);


    
});



// --------------- AdminLogin Controller --------------

Route::get('/admin-login', [AdminLoginController::class, 'adminLogin']);
Route::post('/check-auth', [AdminLoginController::class, 'checkAuth']);

// ------------------------- FrontEnd ------------------
// ----------------------- IndexController --------------
Route::get('/', [HomeController::class, 'home']);

//-------------------- Answer Poll ----------------------
Route::get('/poll-answer/{id}', [PollAnswerController::class, 'pollAnswer']);
Route::post('/submit-poll-answer', [PollAnswerController::class, 'submitPollAnswer']);
Route::get('/get-poll-result', [PollAnswerController::class, 'pollResult']);

