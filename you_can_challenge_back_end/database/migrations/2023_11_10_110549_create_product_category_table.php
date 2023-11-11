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
        Schema::create('product_category', function (Blueprint $table) {
            $table->id("product_category_id");
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("product_id")->on("products");
            $table->unsignedBigInteger("categorie_id");
            $table->foreign("categorie_id")->references("categorie_id")->on("categories");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
};
