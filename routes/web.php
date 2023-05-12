<?php

use App\Http\Controllers\UserController;
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
})->name('hello');

#USER

#login
Route::view('/login', 'user.login')->name('user.login')->middleware('guest');

#register
Route::view('/registre-se', 'user.register')->name('user.register')->middleware('guest');

#forgot-passoword
Route::view('/esqueci-a-senha', 'user.password-forget')->middleware('guest')->name('user.forget');

#user controller actions
Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'auth')->name('user.auth');
    Route::post('/registre-se', 'register')->name('user.create');
    Route::get('/sair', [UserController::class,'logout'])->name('logout');
});

#NOTE

#note workplace
Route::view('/note','note.workplace')->name('note.workplace')->middleware('auth');