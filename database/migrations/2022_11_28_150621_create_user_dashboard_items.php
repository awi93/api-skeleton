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
        Schema::create('user_dashboard_items', function (Blueprint $table) {
            $table->bigInteger("user_dashboard_id");
            $table->bigInteger("dashboard_id");
            $table->integer("index")->nullable(false);

            $table->primary(["user_dashboard_id", "dashboard_id"]);
            $table->foreign("user_dashboard_id")->on("user_dashboards")->references("id")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("dashboard_id")->on("dashboards")->references("id")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_dashboard_items');
    }
};
