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
        Schema::create('change_logs', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("data_id", 50)->nullable(false);
            $table->smallInteger("data_type")->nullable(false);
            $table->smallInteger("event")->nullable(false);
            $table->json("data")->nullable(false);
            $table->timestamp("created_at")->nullable(false);
            $table->string("created_by", 255)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('change_logs');
    }
};
