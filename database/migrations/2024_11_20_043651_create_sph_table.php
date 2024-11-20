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
        Schema::create('sph', function (Blueprint $table) {
            $table->id();
            $table->string('project');
            $table->string('item');
            $table->string('unit');
            $table->decimal('price', 10, 2);
            $table->string('kode_sph'); // Kode urut SPH
            $table->date('tanggal');
            $table->unsignedBigInteger('data_client_id'); // Foreign Key ke tabel data_clients
            $table->string('up');
            $table->decimal('penawaran_harga', 10, 2);
            $table->timestamps();
    
            // Menambahkan foreign key
            $table->foreign('data_client_id')->references('id')->on('data_clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sph');
    }
};
