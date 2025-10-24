<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('jemaats', 'sektor')) {
            Schema::table('jemaats', function (Blueprint $table) {
                $table->string('sektor', 20)->nullable()->after('status_baptis');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('jemaats', 'sektor')) {
            Schema::table('jemaats', function (Blueprint $table) {
                $table->dropColumn('sektor');
            });
        }
    }
};
