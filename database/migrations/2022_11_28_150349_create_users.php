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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->smallInteger("user_type")->nullable();
            $table->bigInteger("role_id")->nullable();
            $table->string("uid", 50)->nullable(false)->unique();
            $table->string("username", 255)->nullable();
            $table->string("email", 255)->nullable();
            $table->boolean('email_verified')->default(false);
            $table->string("phone", 255)->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->string("password", 255)->nullable(false);
            $table->json("profile")->nullable(false);
            $table->smallInteger("status")->nullable(false);
            $table->timestamps();
            $table->string("created_by", 255)->nullable();
            $table->string("updated_by", 255)->nullable();

            $table->foreign("role_id")->on("roles")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
