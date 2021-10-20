<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check())
        {
            return redirect('/connexion');
        }
        else
        {
            if(Auth::user()->user_role == 'main_admin') 
            {
                return $next($request);
            } 
            else 
            {
                abort(404, 'La page ciblée n\'existe pas, veuillez réessayer !');
            }
        }
    }
}