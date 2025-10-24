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
        Schema::create('nyanyians', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_lagu', 50); // Nomor Lagu: KJ 300, PKJ 125, dll
            $table->string('judul_lagu'); // Judul Lagu (Wajib)
            $table->string('kategori')->nullable(); // Kategori: Pujian, Penyembahan, Ucapan Syukur, Natal
            $table->string('sumber_buku', 50)->nullable(); // Sumber: KJ, PKJ, NKB, Lagu Lokal
            $table->longText('lirik'); // Lirik Lagu (Wajib, mendukung formatting)
            $table->boolean('status')->default(1); // 1=Aktif, 0=Nonaktif/Draft
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nyanyians');
    }
};
