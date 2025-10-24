<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jemaats', function (Blueprint $table) {
            $table->text('alamat')->nullable()->after('sektor');
            $table->string('telepon', 20)->nullable()->after('alamat');
            $table->enum('status_sidi', ['Sudah Sidi', 'Belum Sidi'])->default('Belum Sidi')->after('status_baptis');
            $table->string('pekerjaan', 100)->nullable()->after('telepon');
            $table->string('keluarga', 100)->nullable()->after('pekerjaan')->comment('Kepala Keluarga / KK');
        });
    }

    public function down(): void
    {
        Schema::table('jemaats', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'telepon', 'status_sidi', 'pekerjaan', 'keluarga']);
        });
    }
};
