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
        Schema::create('qurbans', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_qurban', 255);
            $table->date('tanggal_pembukaan');
            $table->date('tanggal_penutupan');
            $table->string('status', 50);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qurbans');
    }
};
