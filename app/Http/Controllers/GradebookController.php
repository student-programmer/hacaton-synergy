<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gradebook;
use ReallySimpleJWT\Token;
use App\Models\User;

class GradebookController extends Controller
{
    public function create(Request $request)
	{
		if (!$request->is_teacher) {
			return response(['success' => false, 'message' => 'У вас нет доступа к данной операции'], 403)
				->header('Content-Type', 'application/json');
		}

		if (!$request->is_authenticated) {
			return response(['success' => false, 'message' => 'Для выполнения следующей операции необходимо авторизоваться'], 403)
				->header('Content-Type', 'application/json');
		}

		$data = $request->validate(
			[
				"nickname" => "required|string|min:6|max:15",
				"num" => "required|integer",
				"faculty" => "required|string",
				"specialization" => "required|string",
				"num_course" => "required|integer",
				'date_of_issue' => 'required|date',
			],
			[
				'date_of_issue.required' => 'Дата выдачи обязательна для заполнения',
				'date_of_issue.date' => 'Дата выдачи должна иметь тип данных дата',
				"nickname.required" => "Никнейм обязательно для заполнения",
				"nickname.min" => "Длина никнейма 8 символов",
				"nickname.string" => "Никнейм должен быть строкой",
				"num.required" => "Номер обязателен для заполнения",
				"num.integer" => "Номер должен быть числом",
				"faculty.required" => "Факультет обязателен для заполнения",
				"faculty.string" => "Факультет должен быть строкой",
				"specialization.required" => "Специальность обязательна для заполнения",
				"specialization.string" => "Специальность должна быть строкой",
				"num_course.required" => "Номер курса обязателен для заполнения",
				"num_course.integer" => "Номер курса должен быть числом",
			]
		);

		$find_gradebook = Gradebook::where("num", $data["num"])->first();

		if ($find_gradebook)
		{
			return response(
				[
					"success" => false,
					"message" => "Такая зачетная книжка уже существует"
				],
				400
			)
			->header("Content-Type", "application/json");
		}

		$find_student = User::where('nickname', $data['nickname'])
			->where('role', 'user')->first();

		if (!$find_student)
		{
			return response(
				[
					"success" => false,
					"message" => "Такого ученика не существует"
				],
				404
			)
			->header("Content-Type", "application/json");
		}

		$payload = [
			"num" => $data["num"],
			"faculty" => $data["faculty"],
			"specialization" => $data["specialization"],
			"date_of_issue" => $data['date_of_issue'],
			'first_name' => $find_student->first_name,
			'second_name' => $find_student->second_name,
			'patronymic' => $find_student->patronymic,
			"num_course" => $data["num_course"],
			"student_id" => $find_student->id,
			"teacher_id" => $request->user_id
		];

		Gradebook::create($payload);

		return response(
			[
				"success" => true,
				"message" => "Зачетная книжка создана"
			],
			201
		)
		->header("Content-Type", "application/json");
	}

	public function renderGradebookAddPage(Request $request) {
        if (!array_key_exists('token', $_COOKIE)) {
            return $next($request);
        }

        $token = $_COOKIE['token'];
		$secret = "sec!ReT423*&";
		$validate_token = Token::validate($token, $secret);

		if (!$validate_token) return $next($request);
        
		$token_data = Token::getPayload($token);
		
        if (!$token_data['is_teacher']) {
            return abort(404);
        }

        return view('gradebook.add');
    }

	public function renderMainPage(Request $request) {
		$gradebooks = Gradebook::all();

		return view('index', ['gradebooks' => $gradebooks]);
	}
}
