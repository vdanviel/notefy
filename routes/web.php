<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GithubController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

#AUTH

#login
Route::view('/login', 'auth.login')->name('auth.login')->middleware('guest');

#register
Route::view('/registre-se', 'auth.register')->name('auth.register')->middleware('guest');

Route::view('test', 'auth.register-checked');

#forgot-password
Route::get('/esqueci-a-senha', function () {
    return view('auth.forgot');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);

})->middleware('guest')->name('password.email');

#reset the password
Route::get('/nova-senha/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/nova-senha', function (Request $request) {
    $request->validate(
        [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ],
        [
            'token.required' => "Erro ao receber token de confirmação.",
            'email.required' => "O campo de e-mail é obrigatório.",
            'email.email' => "O campo de e-mail está inválido.",
            'password.required' => "O campo de senha é obrigatório.",
            "password.min" => "O minímo de caracteres são 8.",
            "password.confirmed" => "O campo de confirmação da nova senha está inválido."
        ]
    );
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET ? redirect()->route('auth.login')->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

#user profile
Route::get('/perfil', function(Request $request){

    return view('works.user.profile');

})->name('works.user.profile');

#user controller actions
Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'auth')->name('auth'); //login
    Route::post('/registre-se', 'register')->name('auth.create-request'); //register
    Route::get('/registre-se/token/{token}', 'check_new_user')->name('auth.create.check'); //check the emailed new user
    Route::post('/perfil', 'edit')->name('user.edit');
    Route::get('/sair', 'logout')->name('auth.logout'); //logout
});

#google auth
Route::get('/google/auth', [GoogleController::class, 'redirect'])->name('google.redirect')->middleware('guest');
Route::get('/google/auth/callback', [GoogleController::class, 'callback'])->name('google.callback')->middleware('guest');

#github auth
Route::get('/github/auth', [GithubController::class, 'redirect'])->name('github.redirect')->middleware('guest');
Route::get('/github/auth/callback', [GithubController::class, 'callback'])->name('github.callback')->middleware('guest');

#PAINEL
Route::get('/painel', [DashboardController::class, 'index'])->name('works.dashboard')->middleware('auth');