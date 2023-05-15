<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class GoogleController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        
        $google_user = Socialite::driver('google')->user();

        if (!empty(User::where('email', $google_user->getEmail()))) {

            //se existir um usuario com o mesmo email do google ele é edita, não existir ele é criado
            $user = User::updateOrCreate(
                ['email' => $google_user->getEmail()], 
                
                [
                    'google_id' => $google_user->getId(),
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                ]
            );

        }else{

            //se o usuario google_id não existir ele é criado, se ele existir ele é editado
            $user = User::updateOrCreate(
                ['google_id' => $google_user->getId()], 
                
                [
                    'google_id' => $google_user->getId(),
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                ]
            );
        }

        Auth::login($user);

        return redirect()->route('works.dashboard');
        

    }
}
