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
        Schema::create('role_dashboards', function (Blueprint $table) {
            $table->bigInteger("role_id");
            $table->bigInteger("dashboard_id");

            $table->primary(["role_id", "dashboard_id"]);
            $table->foreign("role_id")->on("roles")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('role_dashboards');
    }
};
