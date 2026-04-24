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
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments("token_id")->primary();
            $table->unsignedInteger("user_id");
            $table->text("token");
            $table->string("ability");
            $table->boolean("revoked")->default(false);
            $table->timestamp("revoked_at")->nullable();
            $table->timestamp("last_used_at")->nullable();
            $table->timestamp("expires_at")->default(DB::raw('(CURRENT_TIMESTAMP + INTERVAL 1 DAY)'));
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
