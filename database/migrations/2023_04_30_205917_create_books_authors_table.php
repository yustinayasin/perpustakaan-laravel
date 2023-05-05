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
        Schema::create('books_authors', function (Blueprint $table) {
            $table->unsignedBigInteger("id_book");
            $table->unsignedBigInteger("id_author");

            $table->foreign("id_book")->references("id")->on("books");
            $table->foreign("id_author")->references("id")->on("authors");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_authors');
    }
};
