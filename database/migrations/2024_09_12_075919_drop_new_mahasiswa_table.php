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
        Schema::dropIfExists('new_mahasiswa');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
