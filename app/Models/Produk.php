<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'gambar', 'id_admin'];

    public function admin(): BelongsTo { return $this->belongsTo(Admin::class, 'id_admin', 'id_admin'); }
}
