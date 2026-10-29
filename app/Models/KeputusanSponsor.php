<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabel: kelola_sponsor (keputusan admin untuk satu pengajuan; id_pengajuan unik)
 */
class KeputusanSponsor extends Model
{
    protected $table = 'kelola_sponsor';
    protected $primaryKey = 'id_kelola_sponsor';
    public $timestamps = false;

    protected $fillable = ['id_pengajuan', 'id_admin', 'status', 'catatan', 'tanggal_keputusan'];

    protected $casts = [
        'tanggal_keputusan' => 'datetime',
    ];
}
