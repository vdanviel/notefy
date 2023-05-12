<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function auth(Request $request){

        //valida os campos
        $request->validate(
            array(
                "email" => ["required", "email"],
                "password" => ["required"]
            ),
            array(
                "email.required" => "O campo do email é obrigatório.",
                "email.email" => "O email deve ser válido.",
                "password.required" => "O campo de senha é obrigatório.",
            )
        );

        //logou
        if ($request->relemberme) {

            if (Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')], true)) {
                $request->session()->regenerate();
     
                return $request->hasSession();
                //return redirect()->route('note.workpage');
            }else {
                return response()->json('Usuario nao autenticado.','401');
            }        

        }else {

            if (Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')], false)) {
                $request->session()->regenerate();
     
                return $request->hasSession();
                //return redirect()->route('note.workpage');
            }else {
                return redirect()->back()->withErrors('Usuário não registrado em nosso banco de dados.');
            }

        }
    
    }

    public function register(Request $request){
        //valida os campos
        $cred = $request->validate(
            array(
                "email" => ["required", "email"],
                "password" => [
                    "required",
                    "min:8",
                    "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/"
                ]
            ),
            array(
                "email.required" => "O campo do email é obrigatório.",
                "email.email" => "O email deve ser válido.",
                "password.required" => "O campo de senha é obrigatório.",
                "password.min" => "A senha deve ter no mínimo 8 caracteres.",
                "password.regex" => "A senha deve ter no mínimo um número, uma letra maíuscula, uma letra minuscula e um caractere especial."
            )
        );
    }

    public function logout(Request $request)
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect(route('hello'));
}
}
