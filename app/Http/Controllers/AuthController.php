<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#models
use App\Models\User;

#Auth
use Illuminate\Auth\Events\PasswordReset;

#supports
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

#helpers
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#sanctum
use Laravel\Sanctum\PersonalAccessToken;

#mails
use App\Mail\NewUserMail;

class AuthController extends Controller{
    
    #AUTH & REGISTER
    //login
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

        //remember-me
        if ($request->relemberme) {

            if (Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')], true)) {

                //if the user is not verified
                if (Auth::user()->email_verified_at == null) {

                    //the last token of the user
                    $token_obj = PersonalAccessToken::where('tokenable_id', Auth::user()->id)->orderBy('tokenable_id', 'desc')->first();

                    //if the user token is expired
                    if ($this->expired_register_token($token_obj) == true){
                        
                        $new_token = $request->user()->createToken('register_token', ['read'], now()->addDay());

                        $link = request()->schemeAndHttpHost() . "/registre-se/token/" . $new_token->plainTextToken;

                        Mail::to($request->user()->email)->send(new NewUserMail($link));

                        //destroying the expired token
                        $token_obj->delete();

                        //logouting
                        $this->logout($request);

                        return redirect()->route('auth.login')->withErrors('A data de expiração desse token acabou. Nós mandamos outro e-mail para você com um token atualizado.');

                    }else{
                        $request->session()->regenerate();

                        //user hasn't verfied the token yet, but the token is not expired
                        return redirect()->route('works.dashboard')->with(['email' => 'Você ainda não ativou sua conta. Por favor, verifique o link que enviamos em seu e-mail.']);
                    }

                }

                $request->session()->regenerate();
        
                return redirect()->route('works.dashboard');
            }else {

                return redirect()->back()->withErrors('Usuário não registrado em nosso banco de dados.');

            }        

        }else {//dont remember me

            if (Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')], false)) {

                //if the user is not verified
                if (Auth::user()->email_verified_at == null) {

                    //the last token of the user
                    $token_obj = PersonalAccessToken::where('tokenable_id', Auth::user()->id)->orderBy('tokenable_id', 'desc')->first();

                    //if the user token is expired
                    if ($this->expired_register_token($token_obj) == true){
                        
                        $new_token = $request->user()->createToken('register_token', ['read'], now()->addDay());

                        $link = request()->schemeAndHttpHost() . "/registre-se/token/" . $new_token->plainTextToken;

                        Mail::to($request->user()->email)->send(new NewUserMail($link));

                        //destroying the expired token
                        $token_obj->delete();

                        //logouting
                        $this->logout($request);

                        return redirect()->route('auth.login')->withErrors('A data de expiração desse token acabou. Nós mandamos outro e-mail para você com um token atualizado.');

                    }else{
                        $request->session()->regenerate();

                        //user hasn't verfied the token yet, but the token is not expired
                        return redirect()->route('works.dashboard')->with(['email' => 'Você ainda não ativou sua conta. Por favor, verifique o link que enviamos em seu e-mail.']);
                    }

                }

                $request->session()->regenerate();
        
                return redirect()->route('works.dashboard');
            }else {

                return redirect()->back()->withErrors('Usuário não registrado em nosso banco de dados.');

            }

        }
    
    }

    //register the user and send the token veryfication email
    public function register(Request $request){
        //valida os campos
        $request->validate(
            array(
                "name" => ["required"],
                "email" => ["required", "email"],
                "password" => [
                    "required",
                    "min:8",
                    "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/",
                    "confirmed"
                ],
            ),
            array(
                "name.required" => "O campo do nome é obrigatório.",
                "email.required" => "O campo do email é obrigatório.",
                "email.email" => "O email deve ser válido.",
                "password.required" => "O campo de senha é obrigatório.",
                "password.min" => "A senha deve ter no mínimo 8 caracteres.",
                "password.regex" => "A senha não atende os requisitos para cadastro.",
                "password.confirmed" => "Não pode haver diferença entre 'Senha' e 'Confirmar senha'"
            )
        );

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(10);
        $user->email_verified_at = null;

        $user->save();

        $token = $user->createToken('register_token', ['read'], now()->addDay());

        $link = $request->schemeAndHttpHost() . "/registre-se/token/" . $token->plainTextToken;

        Mail::to($user->email)->send(new NewUserMail($link));

        return view('auth.newuser-sended-email');

    }
    
    //the link activation alghorithim
    public function check_new_user($token){

        //a classe PersonalAccessToken (use Laravel\Sanctum\PersonalAccessToken;) 
        //trata de questoes da tabela personal_access_token a classe automatica de tokens do Laravel.
        $token_obj = PersonalAccessToken::findToken($token);

        //usuario que acionou o token
        $user = User::find($token_obj->tokenable_id);

        //if the token exists
        if ($token_obj !== null) {

            //se o tipo do token não for de registro
            if ($token_obj->name !== 'register_token') {
                return '[ERRO]: O tipo de token utilizado é inválido.';
            }

            //token expirado?
            if ($this->expired_register_token($token_obj) == true) {
                
                $new_token = $user->createToken('register_token', ['read'], now()->addDay());

                $link = request()->schemeAndHttpHost() . "/registre-se/token/" . $new_token->plainTextToken;

                Mail::to($user->email)->send(new NewUserMail($link));

                //destroying the expired token
                $token_obj->delete();

                return redirect()->route('auth.login')->withErrors('A data de expiração desse token acabou. Nós mandamos outro e-mail para você com um token atualizado.');

            }else{

                //validando o usuario
                $user->email_verified_at = now();
                $user->save();
            
                return view('auth.register-checked');

            }

        }else{

            throw New NotFoundHttpException;

        }
    }

    //function that verify if token_register is expired
    public function expired_register_token($personal_token_obj){

        //se o token estiver expirado
        $expiration_date = Carbon::parse($personal_token_obj->expires_at);
        $now = Carbon::parse(now());

        //verifing
        if($now->gt($expiration_date)){
            return true; //venceu
        }else{
            return false; //n venceu
        }

    }

    #FORGOT PASSWORD
    #send the email with access token
    public function forgot_password(Request $request){

        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'required' => 'O campo não pode estar vazio',
                'email' => 'O email deve ser válido'
            ]
        );

        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }

    #reset the user password on db
    public function reset_password(Request $request){

        $request->validate(
            array(
                'token' => 'required',
                "email" => ["required", "email"],
                "password" => [
                    "required",
                    "min:8",
                    "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/",
                    "confirmed"
                ],

            ),
            array(
                'token.required' => "Erro ao receber token de confirmação.",
                "email.required" => "O campo do email é obrigatório.",
                "email.email" => "O email deve ser válido.",
                "password.required" => "O campo de senha é obrigatório.",
                "password.min" => "A senha deve ter no mínimo 8 caracteres.",
                "password.regex" => "A senha não atende os requisitos para cadastro.",
                "password.confirmed" => "Não pode haver diferença entre 'Senha' e 'Confirmar senha'"
            )
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

    }

    public function logout(Request $request){
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(route('hello'));
    }

}
