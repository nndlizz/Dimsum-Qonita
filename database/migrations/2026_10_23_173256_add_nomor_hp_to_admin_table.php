
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('admin', 'nomor_hp')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->string('nomor_hp', 20)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('admin', 'nomor_hp')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->dropColumn('nomor_hp');
            });
        }
    }
};
