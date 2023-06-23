<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

#support
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#models
use App\Models\User;

class GithubController extends Controller{
    public function redirect(){
        return Socialite::driver('github')->redirect();
    }

    public function callback(){
        
        $github_user = Socialite::driver('github')->user();
        
        if (!empty(User::where('email', $github_user->getEmail()))) {
            
            $user = User::updateOrCreate(
                ['email' => $github_user->getEmail()],
                
                [
                    'github_id' => $github_user->getId(),
                    'name' => $github_user->getName(),
                    'email' => $github_user->getEmail(),
                    'remember_token' => Str::random(10)
                ]
            );

        }else{
            $user = User::updateOrCreate(
                ['github_id' => $github_user->getId()],
                
                [
                    'github_id' => $github_user->getId(),
                    'name' => $github_user->getName(),
                    'email' => $github_user->getEmail(),
                    'remember_token' => Str::random(10)
                ]
            );
        }
        
        Auth::login($user);
        
        return redirect()->route('works.dashboard');
    }

    
}
