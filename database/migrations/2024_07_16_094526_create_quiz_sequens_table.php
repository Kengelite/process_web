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
        Schema::create('quiz_sequens', function (Blueprint $table) {
            $table->uuid('id_answer_quizzes')->primary();
            $table->uuid('answer_quiz_id'); // เพิ่มคอลัมน์สำหรับ FK
            $table->integer('quizzes_id', false, true)->length(10);
            $table->string('next_quiz');
            $table->timestamps();
            $table->softDeletes();

           
             // กำหนด Foreign Key
             $table->foreign('answer_quiz_id')->references('id_answer_quizzes')->on('answer_quizzes')->onDelete('RESTRICT');
             // กำหนด Foreign Key
             $table->foreign('quizzes_id')->references('id_quizzes')->on('quizzes')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_sequens');
    }
};
