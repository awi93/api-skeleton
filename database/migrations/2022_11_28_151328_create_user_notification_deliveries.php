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
    public function up()
    {
        Schema::create('user_notification_deliveries', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("user_notification_id");
            $table->string("channel");
            $table->json("channel_config");
            $table->boolean("is_delivered")->nullable(false)->default(false);
            $table->timestamp("delivered_at")->nullable();
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
        Schema::dropIfExists('user_notification_deliveries');
    }
};
