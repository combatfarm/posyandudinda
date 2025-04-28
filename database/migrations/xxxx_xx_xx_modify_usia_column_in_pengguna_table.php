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
        Schema::table('pengguna', function (Blueprint $table) {
            // Mengubah kolom usia menjadi string dengan panjang yang cukup
            $table->string('usia', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            // Kembalikan ke tipe data sebelumnya jika diperlukan
            $table->integer('usia')->change();
        });
    }
}; 