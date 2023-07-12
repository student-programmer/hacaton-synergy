<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfTokenNotExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!array_key_exists('token', $_COOKIE)) {
            return redirect('/auth/login');
        }

        $token = $_COOKIE['token'];

        if (!$token) {
            return redirect('/auth/login');
        }

        return $next($request);
    }
}
