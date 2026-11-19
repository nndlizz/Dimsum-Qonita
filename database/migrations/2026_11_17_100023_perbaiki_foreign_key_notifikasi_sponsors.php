
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropForeign('notifikasi_id_pengajuan_foreign');
        });

        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreign('id_pengajuan')
                ->references('id_pengajuan')
                ->on('sponsors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropForeign('notifikasi_id_pengajuan_foreign');
        });

        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreign('id_pengajuan')
                ->references('id_pengajuan')
                ->on('ajukan_sponsor')
                ->nullOnDelete();
        });
    }
};
