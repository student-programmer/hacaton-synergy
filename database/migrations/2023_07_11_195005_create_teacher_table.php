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
		if (!Schema::hasTable("teacher"))
		{
			Schema::create("teacher", function (Blueprint $table) {
				$table->id();
				$table->string("first_name"); // имя
				$table->string("second_name"); // фамилия
				$table->string("patronymic"); // отчество
				$table->string("nickname")->unique(); // ник для входа
				$table->json("gradebook_ids")->default("[]"); // зачетные книжки (ids)
				$table->string("password"); // пароль
				$table->timestamps();
			});
		}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher');
    }
};
