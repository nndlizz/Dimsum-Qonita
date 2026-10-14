<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    public $timestamps = false;
    protected $fillable = ['id_pelanggan', 'id_pengajuan', 'judul', 'pesan', 'status_baca', 'created_at'];
    protected $casts = ['status_baca' => 'boolean', 'created_at' => 'datetime'];

    public function pelanggan(): BelongsTo { return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan'); }
    public function pengajuan(): BelongsTo { return $this->belongsTo(AjukanSponsor::class, 'id_pengajuan', 'id_pengajuan'); }
}
