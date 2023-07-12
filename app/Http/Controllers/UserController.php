<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use ReallySimpleJWT\Token;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function renderAddPage(Request $request) {
        if (!array_key_exists('token', $_COOKIE)) {
            return $next($request);
        }

        $token = $_COOKIE['token'];
		$secret = "sec!ReT423*&";
		$validate_token = Token::validate($token, $secret);

		if (!$validate_token) return $next($request);
        
		$token_data = Token::getPayload($token);

        Log::info($token_data);

        if (!$token_data['is_admin']) {
            return abort(404);
        }

        return view('user.add');
    }

    public function create(Request $request) {
        $data = $request->validate([
			"nickname" => "required|string|min:6|max:15",
			"password" => "required|string|min:8",
			"firstname" => "required|string|min:3",
			"lastname" => "required|string|min:3",
			"patronymic" => "required|string|min:3",
			"role" => "required|string"
		],
		[
			"nickname.required" => "Никнейм обязательно для заполнения",
			"nickname.min" => "Длина никнейма 8 символов",
			"nickname.string" => "Никнейм должен быть строкой",
            "firstname.required" => "Имя обязательно для заполнения",
			"firstname.min" => "Длина имени 8 символов",
			"firstname.string" => "Имя должно быть строкой",
            "lastname.required" => "Фамилия обязательно для заполнения",
			"lastname.min" => "Длина фамилии 8 символов",
			"lastname.string" => "Фамилия должна быть строкой",
            "patronymic.required" => "Отчество обязательно для заполнения",
			"patronymic.min" => "Длина отчества 8 символов",
			"patronymic.string" => "Отчество должно быть строкой",
			"password.required" => "Пароль обязателен для заполнения",
			"password.min" => "Длина пароля 8 символов",
			"password.string" => "Пароль должен быть строкой",
			"role.required" => "Роль обязательна для заполнения",
			"role.string" => "Роль должна быть строкой"
		]);

        $find_by_nickname = User::where('nickname', $request->input('nickname'))->first();

        if ($find_by_nickname) {
            return response(['success' => false, 'message' => 'Пользователь с таким никнеймом уже существует'], 400)
                ->header('Content-Type', 'application/json');
        }

        User::create([
            'nickname' => $request->input('nickname'),
            'first_name' => $request->input('firstname'),
            'second_name' => $request->input('lastname'),
            'patronymic' => $request->input('patronymic'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response(['success' => true, 'message' => 'Пользователь создан'], 200)
            ->header('Content-Type', 'application/json');
    }
}
