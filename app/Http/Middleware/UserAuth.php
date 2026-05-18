<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (session()->has('admin_logged_in')) {
            return redirect('log-in')->withErrors([
                'access error' => "you can't access user page."
            ]);
        }

        if (!session()->has('user_logged_in') || session('role') !== 'user') {
            return redirect('user-login')->withErrors(['login_error' => 'Access denied. Please login first']);
        }

        if (session()->has('admin_logged_in')) {
            return redirect('log-in')->withErrors([
                'access error' => "you can't access user page."
            ]);
        }
        return $next($request);
    }
}
