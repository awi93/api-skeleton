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
        Schema::create('role_menus', function (Blueprint $table) {
            $table->bigInteger("role_id");
            $table->bigInteger("menu_id");

            $table->primary(["role_id", "menu_id"]);
            $table->foreign("role_id")->on("roles")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("menu_id")->on("menus")->references("id")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('role_menu_accesses');
    }
};
