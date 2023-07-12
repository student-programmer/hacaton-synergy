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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index()->nullable(false)->comment('Наименование семестра');
            $table->date('beginned_at')->index()->nullable(false)->comment('Начало семестра');
            $table->date('finished_at')->index()->nullable(false)->comment('Конец семестра');
            $table->text('comment')->nullable(true)->comment('Комментарий к семестру');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
