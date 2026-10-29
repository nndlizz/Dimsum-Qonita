<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabel: riwayat_sponsor (log perubahan status pengajuan)
 */
class RiwayatPengajuan extends Model
{
    protected $table = 'riwayat_sponsor';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = ['id_pengajuan', 'id_admin', 'status_sebelumnya', 'status_baru', 'catatan'];

    protected $casts = [
        'tanggal_perubahan' => 'datetime',
    ];
}
