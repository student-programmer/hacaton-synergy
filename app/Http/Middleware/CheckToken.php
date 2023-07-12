<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use ReallySimpleJWT\Parse;
use ReallySimpleJWT\Jwt;
use ReallySimpleJWT\Decode;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;
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
		
		$secret = "sec!ReT423*&";
		
		$validate_token = Token::validate($token, $secret);

		if (!$validate_token) return $next($request);
        
		$token_data = Token::getPayload($token);

        if ($token_data) {
            $is_teacher = $token_data['is_teacher'];
            $is_admin = $token_data['is_admin'];
            $user_id = $token_data['id'];

            $user_is_exist = false;
            $find_user = null;

            if ($is_teacher) {
                $find_user = Teacher::find($user_id);

                $user_is_exist = (bool) $find_user;
            } else if ($is_admin) {
                $find_user = Admin::find($user_id);

                $user_is_exist = (bool) $find_user;
            } else {
                $find_user = Student::find($user_id);

                $user_is_exist = (bool) $find_user;
            }

			$request->merge([
				"is_authenticated" => $user_is_exist,
				"user_id" => $user_id,
				"user" => $find_user,
				"is_admin" => $is_admin,
				"is_teacher" => $is_teacher,
			]);
        }

        return $next($request);
    }
}
