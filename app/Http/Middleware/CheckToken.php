<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use ReallySimpleJWT\Token;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_header = $request->header('Authorization') ?? '';
        $token = str_replace('Bearer ', '', $auth_header);
		
		$secret = env("JWT_KEY");
		
		$validate_token = Token::validate($token, $secret);

		if (!$validate_token) return $next($request);
        
		$token_data = Token::getPayload($token);

        if ($token_data) {
            $user_id = $token_data['id'];
            
            $find_user = User::find($user_id);
			$user_is_exist = (bool) $find_user;

			$request->merge([
				"is_authenticated" => $user_is_exist,
				"user_id" => $user_id,
				"user" => $find_user,
				"is_admin" => $token_data['is_admin'],
				"is_teacher" => $token_data['is_teacher'],
			]);
        }

        return $next($request);
    }
}
