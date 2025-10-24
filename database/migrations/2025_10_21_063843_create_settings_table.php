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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Nama pengaturan (contoh: site_name, alamat_gereja)
            $table->text('value')->nullable(); // Nilai pengaturan
            $table->string('group')->nullable(); // Grup pengaturan (kontak, media_sosial, visual)
            $table->string('type')->default('text'); // Tipe input (text, textarea, url, file)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
