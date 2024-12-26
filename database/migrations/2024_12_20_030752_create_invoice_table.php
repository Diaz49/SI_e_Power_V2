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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('kd_invoice');
            $table->date('tgl_invoice');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('no_bast');
            $table->string('no_bast_2')->nullable();
            $table->string('no_bast_3')->nullable();
            $table->string('no_bast_4')->nullable();
            $table->string('no_bast_5')->nullable();
            $table->string('kd_admin');
            $table->enum('jenis_no', ['PO', 'Kontrak', 'SPK', 'SPPK', 'FPB']);
            $table->string('no_3')->nullable();
            $table->string('no_4')->nullable();
            $table->string('no_5')->nullable();
            $table->date('due');
            $table->unsignedBigInteger('bank_id');
            $table->string('no_fp');
            $table->enum('status',['paid','-'])->default('-');
            $table->date('tgl_paid');

            $table->timestamps();


            $table->foreign('client_id')->references('id')->on('client')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('bank')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
