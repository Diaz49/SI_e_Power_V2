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
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable(); 
            $table->string('nama_barang', 100); 
            $table->integer('qty'); 
            $table->string('satuan', 50); 
            $table->decimal('harga_satuan', 10, 2); 
            $table->decimal('jumlah_harga', 20, 2); 
            $table->timestamps(); 
    
            // Foreign key constraints
            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_detail');
    }
};
