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
       Schema::create('riwayat_sponsor', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->foreignId('id_pengajuan')->constrained('ajukan_sponsor', 'id_pengajuan')->cascadeOnDelete();
            $table->foreignId('id_admin')->nullable()->constrained('admin', 'id_admin')->nullOnDelete();
            $table->string('status_sebelumnya', 30)->nullable();
            $table->string('status_baru', 30);
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_perubahan')->useCurrent();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_sponsor');
    }
};
