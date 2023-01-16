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
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("code", 5)->nullable(false)->unique();
            $table->bigInteger("menu_id")->nullable();
            $table->boolean("is_display")->nullable(false)->default(true);
            $table->string("icon", 255)->nullable();
            $table->string("label", 500)->nullable(false);
            $table->text("description")->nullable();
            $table->string("link", 255)->nullable();
            $table->integer("index")->nullable(false);
            $table->smallInteger("status")->nullable(false);
            $table->timestamps();
            $table->string("created_by", 255)->nullable();
            $table->string("updated_by", 255)->nullable();

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
        Schema::dropIfExists('menus');
    }
};
