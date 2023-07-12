<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		if (!Schema::hasTable("student"))
		{
			Schema::create("student", function (Blueprint $table) {
				$table->id();
				$table->string("first_name"); // имя
				$table->string("second_name"); // фамилия
				$table->string("patronymic"); // отчество
				$table->string("password"); // пароль
        $table->string("nickname")->unique(); // имя пользователя для входа
				$table->timestamps();
			});
		}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
