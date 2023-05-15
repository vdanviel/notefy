<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GithubController extends Controller
{
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
                ]
            );

        }else{
            $user = User::updateOrCreate(
                ['github_id' => $github_user->getId()],
                
                [
                    'github_id' => $github_user->getId(),
                    'name' => $github_user->getName(),
                    'email' => $github_user->getEmail(),
                ]
            );
        }
        
        Auth::login($user);
        
        return redirect()->route('works.dashboard');
    }

}
