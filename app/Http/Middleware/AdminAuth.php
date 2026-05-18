<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        if (!Auth::check()) {
            abort(403, "Access denied. You are not authorized to view this page.");
        }
        $user = Auth::User();

        if (!$user->hasRole('Administrator')) {
            abort(403, "Access denied. You are not authorized to view this page");
        }
        return $next($request);
    }
}
