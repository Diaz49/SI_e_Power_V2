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
            $table->string('kode_sph', 100)->unique(); // Kode urut SPH
            $table->date('tanggal');
            $table->unsignedBigInteger('data_client_id'); // Foreign Key ke tabel data_clients
            $table->string('penawaran_harga');
            $table->string('kd_admin', 50)->nullable();
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('data_client_id')->references('id')->on('client')->onDelete('cascade');
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
