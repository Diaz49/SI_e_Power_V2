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
            $table->string('kd_invoice', 100);
            $table->text('header_deskripsi');
            $table->date('tgl_invoice');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('pt_id');
            $table->string('no_bast_1', 100);
            $table->string('no_bast_2',100)->nullable();
            $table->string('no_bast_3',100)->nullable();
            $table->string('no_bast_4',100)->nullable();
            $table->string('no_bast_5',100)->nullable();
            $table->string('kd_admin',50)->nullable();
            $table->enum('jenis_no', ['PO', 'Kontrak', 'SPK', 'SPPK', 'FPB']);
            $table->string('no_1',100);
            $table->string('no_2',100)->nullable();
            $table->string('no_3',100)->nullable();
            $table->string('no_4',100)->nullable();
            $table->string('no_5',100)->nullable();
            $table->enum('ttd', ['true', 'false'])->default('false');
            $table->date('due');
            $table->unsignedBigInteger('bank_id');
            $table->string('no_fp')->nullable();
            $table->enum('status',['paid','-'])->default('-');
            $table->date('tgl_paid')->nullable();

            $table->timestamps();


            $table->foreign('client_id')->references('id')->on('client')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('bank')->onDelete('cascade');
            $table->foreign('pt_id')->references('id')->on('pt')->onDelete('cascade');
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
