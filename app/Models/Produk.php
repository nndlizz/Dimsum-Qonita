<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'gambar',
        'id_admin',
        'id_kategori',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function cabangs(): BelongsToMany
    {
        return $this->belongsToMany(
            Cabang::class,
            'produk_cabang',
            'id_produk',
            'id_cabang',
            'id_produk',
            'id_cabang'
        )->withPivot('harga')->withTimestamps();
    }
}