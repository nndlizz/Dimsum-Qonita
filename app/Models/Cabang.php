<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cabang extends Model
{
    protected $table = 'cabangs';
    protected $primaryKey = 'id_cabang';

    protected $fillable = [
        'nama_cabang',
        'alamat',
        'foto',
    ];

    public function produks(): BelongsToMany
    {
        return $this->belongsToMany(
            Produk::class,
            'produk_cabang',
            'id_cabang',
            'id_produk',
            'id_cabang',
            'id_produk'
        )->withPivot('harga')->withTimestamps();
    }
}
