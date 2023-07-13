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
        Schema::table('gradebooks', function (Blueprint $table) {
            $table->integer("student_id");
			$table->foreign("student_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gradebooks', function (Blueprint $table) {
            $table->dropColumn('student_id');
        });
    }
};
