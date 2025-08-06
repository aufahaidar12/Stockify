<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger
            $table->string('name');
            $table->integer('minimum_stock')->default(0);
            $table->integer('stock')->default(0);
            $table->decimal('price', 15, 2)->default(0); // Tambah kolom harga
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
