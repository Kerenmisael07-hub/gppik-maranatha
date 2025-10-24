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
        Schema::table('church_profiles', function (Blueprint $table) {
            $table->text('welcome_text')->nullable()->after('content');
            $table->text('visi')->nullable()->after('welcome_text');
            $table->text('misi')->nullable()->after('visi');
            $table->text('sejarah')->nullable()->after('misi');
            $table->string('foto_kiri')->nullable()->after('sejarah');
            $table->string('foto_kanan')->nullable()->after('foto_kiri');
            $table->string('alamat')->nullable()->after('foto_kanan');
            $table->string('telepon')->nullable()->after('alamat');
            $table->string('email')->nullable()->after('telepon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('church_profiles', function (Blueprint $table) {
            $table->dropColumn(['welcome_text', 'visi', 'misi', 'sejarah', 'foto_kiri', 'foto_kanan', 'alamat', 'telepon', 'email']);
        });
    }
};
