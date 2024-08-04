<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_alls', function (Blueprint $table) {
            $table->uuid('id_userall')->primary();
            $table->string('user_fname');
            $table->string('user_lname');
            $table->string('user_mail');
            $table->string('user_password');
            $table->string('user_role',1);
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_alls');
    }
};
