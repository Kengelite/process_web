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
        Schema::create('quiz_options', function (Blueprint $table) {
            $table->uuid('id_options')->primary();
            $table->integer('quizzes_id', false, true)->length(10);
            $table->uuid('name_option');
            $table->timestamps();
            $table->softDeletes();

            // กำหนด Foreign Key
            $table->foreign('quizzes_id')->references('id_quizzes')->on('quizzes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_options');
    }
};
