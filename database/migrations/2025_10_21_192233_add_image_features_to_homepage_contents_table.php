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
        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->string('image_position')->default('right')->after('image_path'); // left or right
            $table->json('images')->nullable()->after('image_position'); // array of image paths
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->dropColumn(['image_position', 'images']);
        });
    }
};
