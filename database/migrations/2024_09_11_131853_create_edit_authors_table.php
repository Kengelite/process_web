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
        Schema::create('edit_authors', function (Blueprint $table) {
            $table->increments('edit_id')->primary();
            $table->string('note');
            $table->uuid('id_emp'); 
            $table->uuid('id_teacher'); 
            $table->uuid('id_documnet'); 
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->foreign('id_emp')->references('emp_id')->on('employees')->onDelete('CASCADE');
            $table->foreign('id_teacher')->references('teacher_id')->on('teachers')->onDelete('CASCADE');
            $table->foreign('id_documnet')->references('documnet_id')->on('documents')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edit_authors');
    }
};
