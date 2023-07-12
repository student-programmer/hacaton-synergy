<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use ReallySimpleJWT\Token;

class AuthController extends Controller
{
    public function login(Request $request)
	{
		$data = $request->validate([
			"nickname" => "required|string|min:15|max:15",
			"password" => "required|string|min:20|max:20",
			"role" => "required|string"
		],
		[
			"nickname.required" => "Имя обязательно для заполнения",
			"nickname.min" => "Длина имени 15 символов",
			"nickname.max" => "Длина имени 15 символов",
			"nickname.string" => "Имя должено быть строкой",
			"password.required" => "Пароль обязателен для заполнения",
			"password.min" => "Длина пароля 20 символов",
			"password.max" => "Длина пароля 20 символов",
			"password.string" => "Пароль должен быть строкой",
			"role.required" => "Роль обязательна для заполнения",
			"role.string" => "Роль должна быть строкой"
		]);

		$payload_jwt = [];

		$find_user = User::where("nickname", $data["nickname"])->first();

		if (!$find_user)
		{
			return response(
				[
					"success" => false,
					"message" => "Пользователя с таким именем не существует"
				],
				400
			)
			->header("Content-Type", "application/json");
		}

		$correct_password = Hash::check($data["password"], $find_user->password);

		if (!$correct_password)
		{
			return response(
				[
					"success" => false,
					"message" => "Пароль неверен"
				],
				400
			)
			->header("Content-Type", "application/json");
		}

		if (
			$find_user->role !== "admin" && $data["role"] === "is-admin" ||
			$find_user->role !== "teacher" && $data["role"] === "is-teacher"
		)
		{
			return response(
				[
					"success" => false,
					"message" => "Доступ закрыт"
				],
				400
			)
			->header("Content-Type", "application/json");
		}

		$payload_jwt["is_teacher"] = $find_user->role === "teacher";
		$payload_jwt["is_admin"] = (bool) $find_user->role === "admin";
		$payload_jwt["id"] = $find_user->id;
		$payload_jwt["exp"] = time() + 3600;
		$payload_jwt["iat"] = time();
		$payload_jwt["iss"] = "localhost";

		$secret = "sec!ReT423*&";
		$token = Token::customPayload($payload_jwt, $secret);

		return response(
			[
				"success" => false,
				"message" => "Выполнен вход",
				"token" => $token
			],
			200
		)
		->header("Content-Type", "application/json");
	}
}