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
        Schema::create('sph_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sph_id');
            $table->string('project', 100);
            $table->string('qty');
            $table->string('satuan');
            $table->decimal('price', 10, 2);
            $table->decimal('jumlah_harga', 20, 2);
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('sph_id')->references('id')->on('sph')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sph_detail');
    }
};
