<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use ReallySimpleJWT\Token;

class AuthController extends Controller
{
    public function login(Request $request)
	{
		$data = $request->validate([
			"nickname" => "required|string|min:15|max:15",
			"password" => "required|string|min:20|max:20",
			"is_teacher" => "boolean",
			"is_admin" => "boolean"
		],
		[
			"nickname.required" => "Имя обязательно для заполнения",
			"nickname.min" => "Длина имени 15 символов",
			"nickname.max" => "Длина имени 15 символов",
			"nickname.string" => "Имя должено быть строкой",
			"password.required" => "Пароль обязателен для заполнения",
			"password.min" => "Длина пароля 20 символов",
			"password.max" => "Длина пароля 20 символов",
			"password.string" => "Пароль должен быть строкой"
		]);

		$is_teacher = $data["is_teacher"];
		$is_admin = $data["is_admin"];
		$payload_jwt = [];

		// Учитель
		if ($is_teacher && !$is_admin)
		{
			$find_teacher = Teacher::where("nickname", $data["nickname"])->first();

			if (!$find_teacher)
			{
				return response(
					[
						"success" => false,
						"message" => "Учитель с таким именем не существует"
					],
					400
				)
				->header("Content-Type", "application/json");
			}

			$correct_password = Hash::check($data["password"], $find_teacher->password);

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

			$payload_jwt["is_admin"] = false;
			$payload_jwt["is_teacher"] = true;
			$payload_jwt["id"] = $find_teacher->id;
		}

		// Админ
		if ($is_admin && !$is_teacher)
		{
			$find_admin = Admin::where("nickname", $data["nickname"])->first();

			if (!$find_admin)
			{
				return response(
					[
						"success" => false,
						"message" => "Админ с таким именем не существует"
					],
					400
				)
				->header("Content-Type", "application/json");
			}

			$correct_password = Hash::check($data["password"], $find_admin->password);

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

			$payload_jwt["is_teacher"] = false;
			$payload_jwt["is_admin"] = true;
			$payload_jwt["id"] = $find_admin->id;
		}

		// Ученик
		if (!$is_teacher && !$is_admin)
		{
			$find_student = Student::where("nickname", $data["nickname"])->first();

			if (!$find_student)
			{
				return response(
					[
						"success" => false,
						"message" => "Студент с таким именем не существует"
					],
					400
				)
				->header("Content-Type", "application/json");
			}

			$correct_password = Hash::check($data["password"], $find_student->password);

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

			$payload_jwt["is_teacher"] = false;
			$payload_jwt["is_admin"] = false;
			$payload_jwt["id"] = $find_student->id;
		}

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