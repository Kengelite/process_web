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
        // สร้างตาราง type_quizzes ก่อน
        Schema::create('type_quizzes', function (Blueprint $table) {
            $table->uuid('id_type_quizzes')->primary();
            $table->string('type_name');
            $table->timestamps();
            $table->softDeletes();
        });

        // สร้างตาราง quizzes ต่อมา
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id_quizzes'); // primary key as integer
            $table->uuid('type_id');
            $table->string('quiz_name');
            $table->timestamps();
            $table->softDeletes();

            // กำหนด Foreign Key
            $table->foreign('type_id')->references('id_type_quizzes')->on('type_quizzes')->onDelete('CASCADE');
        });

        // สร้างตาราง appeals ต่อมา
        Schema::create('appeals', function (Blueprint $table) {
            $table->uuid('id_appeal')->primary();
            $table->uuid('user_id'); // เพิ่มคอลัมน์สำหรับ FK
            $table->string('status_type',1);
            $table->timestamps();
            $table->softDeletes();

            // กำหนด Foreign Key
            $table->foreign('user_id')->references('id_userall')->on('user_alls')->onDelete('CASCADE');
        });

        // สร้างตาราง answer_quizzes ต่อมา
        Schema::create('answer_quizzes', function (Blueprint $table) {
            $table->uuid('id_answer_quizzes')->primary();
            $table->uuid('user_id'); // เพิ่มคอลัมน์สำหรับ FK
            $table->uuid('appeal_id'); // เพิ่มคอลัมน์สำหรับ FK
            $table->integer('quizzes_id', false, true)->length(10); // ควรจะเป็น integer
            $table->string('answer_select');
            $table->timestamps();
            $table->softDeletes();

            // กำหนด Foreign Key
            $table->foreign('user_id')->references('id_userall')->on('user_alls')->onDelete('CASCADE');
            $table->foreign('appeal_id')->references('id_appeal')->on('appeals')->onDelete('CASCADE');
            $table->foreign('quizzes_id')->references('id_quizzes')->on('quizzes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_quizzes');
        Schema::dropIfExists('appeals');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('type_quizzes');
    }
};
