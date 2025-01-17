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
        Schema::create('project_id', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->unique();
            $table->string('nama_project', 100);
            $table->string('nama_client', 100);
            $table->text('alamat');
            $table->bigInteger('hpp');
            $table->bigInteger('rab');
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
        Schema::dropIfExists('project_id');
    }
};
