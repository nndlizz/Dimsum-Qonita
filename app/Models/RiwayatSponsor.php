<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatSponsor extends Model
{
    protected $table = 'riwayat_sponsor';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;
    protected $fillable = ['id_pengajuan', 'id_admin', 'status_sebelumnya', 'status_baru', 'catatan', 'tanggal_perubahan'];
    protected $casts = ['tanggal_perubahan' => 'datetime'];

    public function pengajuan(): BelongsTo { return $this->belongsTo(AjukanSponsor::class, 'id_pengajuan', 'id_pengajuan'); }
    public function admin(): BelongsTo { return $this->belongsTo(Admin::class, 'id_admin', 'id_admin'); }
}
