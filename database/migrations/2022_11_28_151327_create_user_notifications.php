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
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("user_id")->nullable(false);
            $table->string("type", 255)->nullable(false);
            $table->string("cover", 255)->nullable();
            $table->string("title", 500)->nullable(false);
            $table->text("content")->nullable(false);
            $table->string("channels")->nullable(false);
            $table->json("attachment")->nullable();
            $table->smallInteger("status")->nullable(false);
            $table->timestamps();
            $table->string("created_by", 255)->nullable();
            $table->string("updated_by", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
};
