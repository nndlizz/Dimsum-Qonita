<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_admin',
        'email',
        'password',
        'status',
        'jenis_kelamin',
        'alamat',
        'gambar',
        'nomor_hp',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_admin', 'id_admin');
    }

    public function keputusanSponsor(): HasMany
    {
        return $this->hasMany(KelolaSponsor::class, 'id_admin', 'id_admin');
    }

    public function riwayatSponsor(): HasMany
    {
        return $this->hasMany(RiwayatSponsor::class, 'id_admin', 'id_admin');
    }
}