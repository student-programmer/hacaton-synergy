<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth
Route::prefix("/auth")->group(function() {
	Route::post("/login", [AuthController::class, "login"]);

	Route::view("/login", "auth.login")->middleware("redirect_if_token_exist");
});

// Gradebook
Route::prefix("/gradebook")->group(function() {
	Route::post("/create", [GradebookController::class, "create"])->middleware("check_token");
});

Route::prefix("/user")->group(function() {
	Route::get("/", [UserController::class, 'renderProfilePage'])->middleware("redirect_if_token_not_exist");
	Route::get("/add", [UserController::class, 'renderAddPage'])
		->middleware("redirect_if_token_not_exist");

	Route::post('/create', [UserController::class, 'create']);
});

Route::view('/', 'index')->middleware('redirect_if_token_not_exist');