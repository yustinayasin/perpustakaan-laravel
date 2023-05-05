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
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_user");
            $table->unsignedBigInteger("id_book");
            $table->bigInteger("duration");
            $table->date("date_of_borrow");
            $table->date("date_of_return");

            $table->foreign("id_book")->references("id")->on("books");
            $table->foreign("id_user")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowers');
    }
};
