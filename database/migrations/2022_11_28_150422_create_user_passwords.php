<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_passwords', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("user_id")->nullable(false);
            $table->string("password", 255)->nullable(false);
            $table->timestamp("created_at")->nullable(false);
            $table->string("created_by", 255)->nullable(false);

            $table->foreign("user_id")->on("users")->references("id")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_passwords');
    }
};
