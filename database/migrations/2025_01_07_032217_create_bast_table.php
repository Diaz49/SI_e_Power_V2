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
        Schema::create('bast', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode', 100)->nullable();
            $table->string('kode_kontrak', 100)->nullable();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('pt_id');
            $table->string('deskripsi',255);
            $table->string('nama', 50);
            $table->string('jabatan', 255);
            $table->string('satuan', 10);
            $table->string('jumlah_item', 50);
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_invoice', 20, 2);
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
            $table->foreign('pt_id')->references('id')->on('pt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bast');
    }
};
