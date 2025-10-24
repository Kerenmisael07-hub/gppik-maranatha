<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->string('group')->nullable()->after('value');
            $table->string('type')->default('text')->after('group');
        });
    }

    public function down()
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->dropColumn(['group', 'type']);
        });
    }
};