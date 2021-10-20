<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Models\Corporate;
use App\Models\LinnasoftSubscription;
use App\Models\LinnasoftInvoice;
use App\Models\LinnasoftSale;
use App\Models\LinnasoftPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function getUser(Request $request)
    {

        $credentials = $request->all('email', 'password');

        if($request->email != '' && $request->password != '' )
        {
            $remember = $request->has('remember_me') ? true : false;

            if(Auth::attempt($credentials,$remember))
            {  
                if(Auth::user()->user_role == 'main_admin') 
                {
                    return redirect('admin/')->with('status', 'Bienvenue sur '.config('app.name').', '.Auth::user()->first_name);
                }
                elseif(Auth::user()->user_role == 'user_accountant') 
                {
                    return redirect('accountant/')->with('status', 'Bienvenue sur '.config('app.name').', '.Auth::user()->first_name);
                }
                else
                {
                    $active = Corporate::find(Auth::user()->corp_id)->corp_state;
                    if($active == 0)
                    {
                        $error = 'Le compte semble inactif, merci de nous contacter !';
                        return redirect('deconnexion/'.$error);
                    }
                    else
                    {
                        return redirect('dashboard')->with('status', 'Bienvenue sur '.config('app.name').', '.Auth::user()->first_name);
                    }
                }
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

    public function logout($error = null)
    {
        Auth::logout();

        if($error != null)
        {
            return redirect('/connexion')->with('error', $error);
        }
        else
        {
            return redirect('/connexion');
        }
    }
}
