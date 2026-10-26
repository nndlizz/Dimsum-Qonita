<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class AjukanSponsor extends Model
{
    protected $table = 'sponsors';
    protected $primaryKey = 'id_pengajuan';
    protected $fillable = ['id_pelanggan', 'nama_kegiatan', 'nama_penyelenggara', 'tanggal_kegiatan', 'lokasi_kegiatan', 'deskripsi', 'file_proposal', 'status', 'catatan_admin', 'tanggal_pengajuan'];
    protected $casts = ['tanggal_kegiatan' => 'date', 'tanggal_pengajuan' => 'datetime'];

    public function pelanggan(): BelongsTo { return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan'); }
    public function notifications(): HasMany { return $this->hasMany(Notifikasi::class, 'id_pengajuan', 'id_pengajuan'); }
}
