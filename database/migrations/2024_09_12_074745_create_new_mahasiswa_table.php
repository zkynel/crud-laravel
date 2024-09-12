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
        Schema::create('new_mahasiswa', function (Blueprint $table) {
                    $table->integer('nim');
                    $table->unique('nim');
                    $table->string('nama');
                    $table->string('jurusan');
                    $table->timestamps();
                    $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_mahasiswa');
    }
};
