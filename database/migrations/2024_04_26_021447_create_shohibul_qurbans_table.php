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
        Schema::create('shohibul_qurbans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('qurban_id')->constrained('qurbans');
            $table->string('nama', 255);
            $table->string('no_telepon', 15);
            $table->string('metode_qurban');
            $table->string('jenis_hewan');
            $table->integer('jumlah')->unsigned();
            $table->string('alamat', 225);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shohibul_qurbans');
    }
};
