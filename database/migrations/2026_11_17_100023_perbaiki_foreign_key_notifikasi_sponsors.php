<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreign('id_pengajuan', 'notifikasi_id_pengajuan_foreign')
                ->references('id_pengajuan')
                ->on('sponsors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        try {
            Schema::table('notifikasi', function (Blueprint $table) {
                $table->dropForeign(['id_pengajuan']);
            });
        } catch (\Throwable $e) {
            // Abaikan jika tidak ada
        }

        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreign('id_pengajuan', 'notifikasi_id_pengajuan_foreign')
                ->references('id_pengajuan')
                ->on('ajukan_sponsor')
                ->nullOnDelete();
        });
    }
};