<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOnAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is_admin) {
            return response(['success' => false, 'message' => 'У вас нет доступа к данной операции, так как она доступна только администратору'], 403)
                ->header('Content-Type', 'application/json');
        }

        return $next($request);
    }
}
