<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gradebook;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class GradebookController extends Controller
{
    public function create(Request $request)
	{
		if (!$request->is_admin)
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

		$data = $request->validate(
			[
				"num" => "required|integer",
				"faculty" => "required|string",
				"specialization" => "required|string",
				"num_course" => "required|integer",
				"teacher_nick" => "required|string|min:15|max:15",
				"student_nick" => "required|string|min:15|max:15"
			],
			[
				"num.required" => "Номер обязателен для заполнения",
				"num.integer" => "Номер должен быть числом",
				"faculty.required" => "Факультет обязателен для заполнения",
				"faculty.string" => "Факультет должен быть строкой",
				"specialization.required" => "Специальность обязательна для заполнения",
				"specialization.string" => "Специальность должна быть строкой",
				"num_course.required" => "Номер курса обязателен для заполнения",
				"num_course.integer" => "Номер курса должен быть числом",
				"teacher_nick.required" => "Ник учителя обязателен для заполнения",
				"teacher_nick.min" => "Длина ника учителя 15 символов",
				"teacher_nick.max" => "Длина имени учителя 15 символов",
				"student_nick.required" => "Ник ученика обязателен для заполнения",
				"student_nick.min" => "Длина ника ученика 15 символов",
				"student_nick.max" => "Длина ника ученика 15 символов"
			]
		);

		$find_gradebook = Gradebook::where("num", $data["num"])->first();

		if ($find_gradebook)
		{
			return response(
				[
					"success" => false,
					"message" => "Зачетная книжка по такому идентификатору уже существует"
				],
				400
			)
			->header("Content-Type", "application/json");
		}

		$find_teacher = User::where("nickname", $data["teacher_nick"])->first();

		if (!$find_teacher)
		{
			return response(
				[
					"success" => false,
					"message" => "Учителя по такому никнейму не существует"
				],
				400
			)
			->header("Content-Type", "application/json");
		}

		$find_student = User::where("nickname", $data["student_nick"])->first();

		if (!$find_student)
		{
			return response(
				[
					"success" => false,
					"message" => "Ученика по такому никнейму не существует"
				],
				400
			)
			->header("Content-Type", "application/json");
		}

		$payload = [
			"num" => $data["num"],
			"faculty" => $data["faculty"],
			"specialization" => $data["specialization"],
			"date_of_issue" => time(),
			"num_course" => $data["num_course"]
		];

		Gradebook::create($payload);

		return response(
			[
				"success" => true,
				"message" => "Книжка добавлена"
			],
			201
		)
		->header("Content-Type", "application/json");
	}
}
