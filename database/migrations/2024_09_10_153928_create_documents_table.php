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
        Schema::create('sexes', function (Blueprint $table) {
            $table->increments('sex_id')->primary();
            $table->string('sex_name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('positions', function (Blueprint $table) {
            $table->increments('position_id')->primary();
            $table->string('positon_name'); 
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
        Schema::create('academics', function (Blueprint $table) {
            $table->increments('academic_id')->primary();
            $table->string('academic_name'); 
            $table->string('academic_stort_name'); 
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
        Schema::create('teachers', function (Blueprint $table) {
            $table->uuid('teacher_id')->primary();
            $table->string('teacher_name');
            $table->string('picture_url');
            $table->integer('id_position', false, true)->length(10);
            $table->integer('id_sex', false, true)->length(10);
            $table->integer('id_aca', false, true)->length(10);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('id_position')->references('position_id')->on('positions')->onDelete('CASCADE');
            $table->foreign('id_sex')->references('sex_id')->on('sexes')->onDelete('CASCADE');
            $table->foreign('id_aca')->references('academic_id')->on('academics')->onDelete('CASCADE');
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('emp_id')->primary();
            $table->string('emp_name');
            $table->string('picture_url');
            $table->integer('id_position', false, true)->length(10);
            $table->integer('id_sex', false, true)->length(10); 
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('id_position')->references('position_id')->on('positions')->onDelete('CASCADE');
            $table->foreign('id_sex')->references('sex_id')->on('sexes')->onDelete('CASCADE');
        });
        Schema::create('years', function (Blueprint $table) {
            $table->increments('year_id')->primary();
            $table->string('year_name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
        Schema::create('cotton', function (Blueprint $table) {
            $table->increments('cotton_id')->primary();
            $table->string('cotton_name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
        Schema::create('type_alls', function (Blueprint $table) {
            $table->increments('type_all_id')->primary();
            $table->string('type_all_name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('documnet_id')->primary();
            $table->string('id_number'); // เพิ่มคอลัมน์สำหรับ FK
            $table->string('document_name');
            $table->integer('version');
            $table->timestamp('end_time')->nullable();
            $table->unsignedInteger('id_year'); 
            $table->unsignedInteger('id_cotton'); 
            $table->unsignedInteger('id_type'); 
            $table->uuid('start_teacher')->nullable();  
            $table->uuid('start_employee')->nullable(); 
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('id_type')->references('type_all_id')->on('type_alls')->onDelete('CASCADE');
            $table->foreign('id_year')->references('year_id')->on('years')->onDelete('CASCADE');
            $table->foreign('id_cotton')->references('cotton_id')->on('cotton')->onDelete('CASCADE');
            $table->foreign('start_teacher')->references('teacher_id')->on('teachers')->onDelete('set null');
            $table->foreign('start_employee')->references('emp_id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('employees');
    }
};