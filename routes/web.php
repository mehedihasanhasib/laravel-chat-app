<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventFireController;
use App\Http\Controllers\GetReceiverInfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('get-receiver-info/{id}', [GetReceiverInfoController::class, 'getUserInfo']);

Route::get('/event', [EventFireController::class, 'fire_event'])
    ->name('event_fire');

Route::post('send-message', [SendMessageController::class, 'send_message']);
Route::post('load-chats', [SendMessageController::class, 'load_chats']);

Route::get('/dashboard', [DashboardController::class, 'load_dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
