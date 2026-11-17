<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Authenticatable
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'email',
        'password',
        'no_telepon',
        'alamat',
    ];

    protected $hidden = ['password'];

    public function pengajuanSponsor(): HasMany
    {
        return $this->hasMany(
            AjukanSponsor::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(
            Notifikasi::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }
}