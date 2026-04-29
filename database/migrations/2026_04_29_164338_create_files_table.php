<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments("file_id")->primary();
            $table->unsignedInteger("uploaded_by_user_id");
            $table->text("file_path");
            $table->bigInteger("file_size")->unsigned();
            $table->enum("file_type", ["document", "pdf"]);
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign("uploaded_by_user_id")->references("user_id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
