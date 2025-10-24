<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('keterangan')->nullable();
            $table->integer('kuantitas')->default(1);
            $table->string('lokasi')->nullable();
            $table->string('nomor_serial')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
};
