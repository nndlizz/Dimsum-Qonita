
@extends('pelanggan.layout.app')

@section('content')

<style>
    .notification-page {
        background-color: #FFF4E5;
        min-height: 75vh;
        padding: 50px 0;
        font-family: 'Poppins', sans-serif;
    }

    .notification-title {
        color: #820000;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .notification-subtitle {
        color: #777;
        font-size: 14px;
        margin-bottom: 30px;
    }

    .notification-card {
        background: #FFFFFF;
        border-radius: 14px;
        padding: 22px 25px;
        margin-bottom: 18px;
        border-left: 5px solid #820000;
        box-shadow: 0 3px 12px rgba(0,0,0,0.05);
    }

    .notification-card h6 {
        color: #820000;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .notification-message {
        color: #666;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .notification-date {
        color: #999;
        font-size: 12px;
    }

    .notification-status {
        font-size: 12px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .status-diajukan {
        background: #FFF0D5;
        color: #A66A00;
    }

    .status-diproses {
        background: #E5EEFF;
        color: #2856A5;
    }

    .status-diterima {
        background: #E1F5E8;
        color: #237A43;
    }

    .status-ditolak {
        background: #FCE4E4;
        color: #B42318;
    }

    .status-selesai {
        background: #EDE5F7;
        color: #6941A5;
    }

    .notification-note {
        background: #FFF4E5;
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 15px;
    }

    .notification-note h6 {
        font-size: 13px;
        margin-bottom: 6px;
    }

    .notification-note p {
        color: #666;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .notification-empty {
        background: #FFFFFF;
        border-radius: 14px;
        padding: 45px 20px;
        text-align: center;
        color: #888;
    }

    @media (max-width: 576px) {
        .notification-page {
            padding: 30px 15px;
        }

        .notification-card {
            padding: 18px;
        }
    }
</style>

<section class="notification-page">
    <div class="container">

        <div class="mb-4">
            <h2 class="notification-title">Notifikasi</h2>
            <p class="notification-subtitle">
                Informasi perkembangan pengajuan sponsor kamu.
            </p>
        </div>

        {{-- Contoh notifikasi sementara --}}

        <div class="notification-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                <h6>Pengajuan Sponsor</h6>
                <span class="notification-status status-diterima">
                    Diterima
                </span>
            </div>

            <p class="notification-message">
                Pengajuan sponsor kegiatan kamu telah disetujui oleh admin.
            </p>

            <div class="notification-note">
                <h6>Catatan Admin</h6>
                <p>
                    Selamat! Pengajuan sponsor kamu telah disetujui.
                    Silakan hubungi Ibu Rina untuk koordinasi lebih lanjut.
                </p>
            </div>

            <span class="notification-date">
                11 November 2026
            </span>
        </div>

        <div class="notification-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                <h6>Pengajuan Sponsor</h6>
                <span class="notification-status status-diproses">
                    Diproses
                </span>
            </div>

            <p class="notification-message">
                Pengajuan sponsor kegiatan kamu sedang ditinjau oleh admin.
                Silakan tunggu informasi selanjutnya.
            </p>

            <span class="notification-date">
                10 November 2026
            </span>
        </div>

        <div class="notification-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                <h6>Pengajuan Sponsor</h6>
                <span class="notification-status status-ditolak">
                    Ditolak
                </span>
            </div>

            <p class="notification-message">
                Pengajuan sponsor kegiatan kamu belum dapat disetujui.
            </p>

            <div class="notification-note">
                <h6>Catatan Admin</h6>
                <p>
                    Mohon maaf, pengajuan belum sesuai dengan kriteria
                    kerja sama yang berlaku.
                </p>
            </div>

            <span class="notification-date">
                9 November 2026
            </span>
        </div>

    </div>
</section>

@endsection
