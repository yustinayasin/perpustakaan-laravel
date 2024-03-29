<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authorities_users', function (Blueprint $table) {
            $table->unsignedBigInteger("id_authority");
            $table->unsignedBigInteger("id_user");

            $table->foreign("id_authority")->references("id")->on("authorities");
            $table->foreign("id_user")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorities_users');
    }
};
