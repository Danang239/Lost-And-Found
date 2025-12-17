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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Nama Barang
            $table->text('description');         // Deskripsi
            $table->string('category');          // Kategori
            $table->string('location');          // Lokasi Hilang/Ditemukan
            $table->date('lost_date');           // Tanggal Hilang/Ditemukan
            $table->string('features')->nullable(); // Ciri-ciri/pertanyaan saat ditemukan
            $table->string('image')->nullable(); // Foto barang
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pemilik barang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
