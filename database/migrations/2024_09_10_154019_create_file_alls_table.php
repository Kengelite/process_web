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
        Schema::create('file_alls', function (Blueprint $table) {
            $table->uuid('file_all_id')->primary();
            $table->string('file_all_name');
            $table->string('file_url');
            $table->string('thumbnail_url')->nullable();
            $table->integer('status');
            $table->uuid('id_documnet'); 
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->foreign('id_documnet')->references('documnet_id')->on('documents')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_alls');
    }
};
