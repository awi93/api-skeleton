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
        Schema::create('user_dashboards', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("user_id")->nullable(false);
            $table->string("label", 255)->nullable(false);
            $table->text("description")->nullable();
            $table->smallInteger("status");
            $table->timestamps();
            $table->string("created_by", 255)->nullable();
            $table->string("updated_by", 255)->nullable();

            $table->foreign("user_id")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_dashboards');
    }
};
