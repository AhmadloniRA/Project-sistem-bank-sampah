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
        Schema::create('setoran_sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('users')->onDelete('cascade');
            $table->enum('jenis_sampah', ['botol plastik', 'kardus', 'kaleng']);
            $table->double('berat_kg');
            $table->integer('harga_beli_nasabah');
            $table->integer('harga_jual_pengepul');
            $table->bigInteger('total_harga_nasabah');
            $table->enum('status', ['gudang', 'terjual'])->default('gudang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran_sampah');
    }
};
