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
            $table->unsignedBigInteger('po_id'); 
            $table->string('nama_barang', 100); 
            $table->integer('qty'); 
            $table->string('satuan', 50); 
            $table->decimal('harga_satuan', 10, 2); 
            $table->timestamps(); 
    
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
