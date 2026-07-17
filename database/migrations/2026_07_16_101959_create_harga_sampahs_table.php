<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('harga_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_sampah')->unique();
            $table->integer('harga_beli_nasabah');
            $table->integer('harga_jual_pengepul');
            $table->timestamps();
        });

        DB::table('harga_sampah')->insert([
            [
                'jenis_sampah' => 'botol plastik',
                'harga_beli_nasabah' => 3000,
                'harga_jual_pengepul' => 4500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_sampah' => 'kardus',
                'harga_beli_nasabah' => 2000,
                'harga_jual_pengepul' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_sampah' => 'kaleng',
                'harga_beli_nasabah' => 5000,
                'harga_jual_pengepul' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_sampah');
    }
};
