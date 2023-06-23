<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

#controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
})->name('hello');

#AUTH
#login
Route::view('/login', 'auth.login')->name('auth.login')->middleware('guest');

#register
Route::view('/registre-se', 'auth.register')->name('auth.register')->middleware('guest');

#forgot-password form
Route::get('/esqueci-a-senha', function () {
    return view('auth.forgot');
})->middleware('guest')->name('password.request');

#reset the password page
Route::get('/nova-senha/{token}', function (string $token) {
    return view('auth.reset-password')->with('token', $token);
})->middleware('guest')->name('password.reset');

#auth controller
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'auth')->name('auth'); //login
    Route::post('/registre-se', 'register')->name('auth.create-request'); //register
    Route::get('/registre-se/token/{token}', 'check_new_user')->name('auth.create.check'); //check the emailed new user
    Route::post('/esqueci-a-senha', 'forgot_password')->middleware('guest')->name('password.email');//send the email with access token
    Route::post('/nova-senha', 'reset_password')->middleware('guest')->name('password.update');//reseting the password action
    Route::get('/sair', 'logout')->name('auth.logout'); //logout
});

#USER
#user profile
Route::get('/perfil', function(){

    return view('works.user.profile');

})->name('works.user.profile');

#google auth
Route::get('/google/auth', [GoogleController::class, 'redirect'])->name('google.redirect')->middleware('guest');
Route::get('/google/auth/callback', [GoogleController::class, 'callback'])->name('google.callback')->middleware('guest');

#github auth
Route::get('/github/auth', [GithubController::class, 'redirect'])->name('github.redirect')->middleware('guest');
Route::get('/github/auth/callback', [GithubController::class, 'callback'])->name('github.callback')->middleware('guest');

#PAINEL
Route::get('/painel', [DashboardController::class, 'index'])->name('works.dashboard')->middleware('auth');