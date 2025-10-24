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
        Schema::table('galleries', function (Blueprint $table) {
            $table->enum('media_type', ['image', 'video'])->default('image')->after('id');
            $table->string('video_path')->nullable()->after('image_path');
            $table->string('thumbnail_path')->nullable()->after('video_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'video_path', 'thumbnail_path']);
        });
    }
};
