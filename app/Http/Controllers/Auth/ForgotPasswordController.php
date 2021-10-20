<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Auth;

//use Illuminate\Foundation\Auth\ResetsPasswords;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        if($request->email != '')
        {
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL))
            {
                $user = User::where('email',$request->email)->exists();
                if($user)
                {
                    $status = Password::sendResetLink($request->only('email'));
                    return view('auth.password-link-sent')->with('email', $request->email);
                }
                else
                {
                    return back()->with('status','Adresse mail introuvable !')->withInput();
                }
            }
            else
            {
                return back()->with('status','Adresse mail invalide !')->withInput();
            }
        }
        else
        {
            return back()->with('status','Renseignez l\'adresse mail associée à votre compte !')->withInput();
        }
    }

    public function getResetToken($token, $email)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function createNewPassword(Request $request)
    {
        if($request->email != '' && $request->password != '' && $request->confirm_password != '' && $request->token != '')
        {
            $pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
            if(preg_match($pattern,$request->password))
            {
                if($request->password == $request->confirm_password)
                {
                    $status = Password::reset(
                        $request->only('email', 'password', 'confirm_password', 'token'),
                        function ($user, $password) use ($request){
                            $user->forceFill([
                                'password' => Hash::make($password)
                            ])->save();
                
                            $user->setRememberToken(Str::random(60));
                            event(new PasswordReset($user));
                        }
                    );
                    return redirect('/connexion')->with('success', 'Votre mot de passe a été réinitialisé avec succès !');
                }
                else
                {
                    return back()->with('status', 'La confirmation doit correspondre au mot de passe !')->withInput();
                }
            }
            else
            {
                return back()->with('status', 'Le mot de passe doit contenir au moins 8 caractères dont 1 majuscule, 1 minuscule et 1 chiffre !')->withInput();
            }
        }
        else
        {
            return back()->with('status', 'Entrez le mot de passe et la confirmation !')->withInput();
        }
    }
}
