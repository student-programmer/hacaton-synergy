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
		if (!Schema::hasTable("gradebooks"))
		{
			Schema::create("gradebooks", function (Blueprint $table) {
				$table->id();
				$table->integer("num")->unique(); // номер
				$table->string("faculty"); // факультет
				$table->string("specialization"); // специальность 
				$table->date("date_of_issue"); // дата выдачи
				$table->integer("num_course"); // номер курса
				$table->timestamps();
			});
		}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gradebooks');
    }
};
