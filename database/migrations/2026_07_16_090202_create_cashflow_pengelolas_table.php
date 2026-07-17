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
        Schema::create('cashflow_pengelola', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_aliran', ['masuk', 'keluar']);
            $table->bigInteger('nominal');
            $table->string('kategori');
            $table->text('keterangan');
            $table->bigInteger('sisa_saldo_kas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashflow_pengelola');
    }
};
