
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_cabang', function (Blueprint $table) {
            $table->id('id_produk_cabang');

            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_cabang');

            $table->decimal('harga', 12, 2);

            $table->timestamps();

            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('produk')
                ->cascadeOnDelete();

            $table->foreign('id_cabang')
                ->references('id_cabang')
                ->on('cabangs')
                ->cascadeOnDelete();

            $table->unique(['id_produk', 'id_cabang']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_cabang');
    }
};
