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
        Schema::create('po', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('kode_po', 100)->unique(); // Kode unik untuk setiap purchase order
            $table->date('tanggal_po'); // Tanggal purchase
            $table->unsignedBigInteger('vendor_id'); // Relasi ke tabel vendor
            $table->string('buyer', 50); // Kode unik untuk setiap purchase order
            $table->text('perihal')->nullable(); // Catatan pertama
            $table->text('catatan')->nullable(); // Catatan pertama
            $table->text('catatan_2')->nullable(); // Catatan kedua
            $table->decimal('diskon', 10, 2)->nullable(); // Diskon
            $table->timestamps(); // Untuk kolom created_at dan updated_at

            // Foreign key constraints
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po');
    }
};
