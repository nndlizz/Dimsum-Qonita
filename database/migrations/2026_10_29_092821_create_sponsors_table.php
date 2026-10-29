<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id('id_pengajuan');

            $table->foreignId('id_pelanggan')
                ->constrained('pelanggan', 'id_pelanggan')
                ->cascadeOnDelete();

            $table->string('nama_kegiatan', 150);
            $table->string('nama_penyelenggara', 150);
            $table->date('tanggal_kegiatan');
            $table->text('lokasi_kegiatan');
            $table->text('deskripsi');
            $table->string('file_proposal', 255)->nullable();

            $table->enum('status', [
                'diajukan',
                'diproses',
                'diterima',
                'ditolak',
                'selesai',
            ])->default('diajukan');

            $table->text('catatan_admin')->nullable();

            $table->timestamp('tanggal_pengajuan')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};