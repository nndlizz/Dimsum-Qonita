<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Tabel: ajukan_sponsor (pengajuan sponsor dari pelanggan)
 */
class PengajuanSponsor extends Model
{
    protected $table = 'ajukan_sponsor';
    protected $primaryKey = 'id_pengajuan';

    /**
     * Daftar status => label.
     * Samakan dengan nilai status yang dipakai teman-temanmu
     * (default di database = 'diajukan').
     */
    public const STATUS = [
        'diajukan'  => 'Diajukan',
        'diproses'  => 'Diproses',
        'disetujui' => 'Disetujui',
        'ditolak'   => 'Ditolak',
    ];

    /** status => warna badge Bootstrap */
    public const WARNA = [
        'diajukan'  => 'secondary',
        'diproses'  => 'warning',
        'disetujui' => 'success',
        'ditolak'   => 'danger',
    ];

    protected $fillable = [
        'id_pelanggan', 'nama_kegiatan', 'nama_penyelenggara', 'tanggal_kegiatan',
        'lokasi_kegiatan', 'deskripsi', 'file_proposal', 'status', 'tanggal_pengajuan',
    ];

    protected $casts = [
        'tanggal_kegiatan'  => 'date',
        'tanggal_pengajuan' => 'datetime',
    ];

    /** Supaya {pengajuan} di URL memakai id_pengajuan */
    public function getRouteKeyName(): string
    {
        return 'id_pengajuan';
    }

    public function keputusan(): HasOne
    {
        return $this->hasOne(KeputusanSponsor::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(RiwayatPengajuan::class, 'id_pengajuan', 'id_pengajuan')
            ->orderByDesc('tanggal_perubahan')
            ->orderByDesc('id_riwayat');
    }

    public function getLabelStatusAttribute(): string
    {
        return self::STATUS[$this->status] ?? ucfirst((string) $this->status);
    }

    public function getWarnaStatusAttribute(): string
    {
        return self::WARNA[$this->status] ?? 'secondary';
    }
}
