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
        Schema::create('po_detail', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('po_id'); // Relasi ke tabel purchase orders
            $table->string('nama_barang'); // Nama barang
            $table->integer('qty'); // Jumlah barang
            $table->string('satuan'); // Satuan (misal: pcs, kg, dll)
            $table->decimal('harga_satuan', 10, 2); // Harga satuan
            $table->timestamps(); // Untuk kolom created_at dan updated_at
    
            // Foreign key constraints
            $table->foreign('po_id')->references('id')->on('po')->onDelete('cascade');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_detail');
    }
};
