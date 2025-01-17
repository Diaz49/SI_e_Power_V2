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
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('nama_client', 100);
            $table->text('alamat');
            $table->string('no_tlp');
            $table->string('up_invoice', 50);
            $table->string('up_sph', 50);
            $table->timestamps();
            
            $table->unsignedBigInteger('pt_id');
            $table->foreign('pt_id')->references('id')->on('pt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
