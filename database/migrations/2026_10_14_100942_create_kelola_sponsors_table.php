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
        Schema::create('kelola_sponsor', function (Blueprint $table) {
            $table->id('id_kelola_sponsor');
            $table->foreignId('id_pengajuan')->unique()->constrained('ajukan_sponsor', 'id_pengajuan')->cascadeOnDelete();
            $table->foreignId('id_admin')->constrained('admin', 'id_admin')->cascadeOnDelete();
            $table->string('status', 30);
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_keputusan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_sponsor');
    }
};
