<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewMessageController;
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

Route::get(
    '/',
    [NewMessageController::class, 'index']
);


Route::get('/message', function () {
    return view('welcome');
});
