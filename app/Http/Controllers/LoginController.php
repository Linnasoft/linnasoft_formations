<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginIndex()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $credentials = $request->all('email', 'password');

        if($request->email != '' && $request->password != '' )
        {
            $remember = $request->has('remember_me') ? true : false;

            if(Auth::attempt($credentials,$remember))
            {  
                return redirect('admin-dashboard')->with('status', 'Bienvenue sur '.config('app.name').', '.Auth::user()->firstname);
            }
            else
            {
                return back()->with('status', 'Vos identifiants sont incorrects !')->withInput();
            }
        }
        else
        {
            return back()->with('status', 'Renseignez l\'email et le mot de passe !')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/connexion');
    }
}
