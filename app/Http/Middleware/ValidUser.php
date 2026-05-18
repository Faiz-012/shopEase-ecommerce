<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use  Illuminate\Support\Facades\Auth;
class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if($request->is('dashbord')){
            echo "<h2> We Are Now On Valid User MiddleWare</h2>";
        }
        if (Auth::check()) {

            if ($request->is('login') || $request->is('register')) {
                return redirect('/dashbord');
            }
            return $next($request);
        } else {
            
            if ($request->is('dashbord')) {
                return redirect('login');
            }   
        }

        return $next($request);
    }
}
