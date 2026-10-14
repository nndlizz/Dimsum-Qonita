<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelolaSponsor extends Model
{
    protected $table = 'kelola_sponsor';
    protected $primaryKey = 'id_kelola_sponsor';
    public $timestamps = false;
    protected $fillable = ['id_pengajuan', 'id_admin', 'status', 'catatan', 'tanggal_keputusan'];
    protected $casts = ['tanggal_keputusan' => 'datetime'];

    public function pengajuan(): BelongsTo { return $this->belongsTo(AjukanSponsor::class, 'id_pengajuan', 'id_pengajuan'); }
    public function admin(): BelongsTo { return $this->belongsTo(Admin::class, 'id_admin', 'id_admin'); }
}
