
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

    .notification-card.unread {
        background: #FFFCF7;
        border-left-color: #820000;
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

    .status-unread {
        background: #FFF0D5;
        color: #A66A00;
    }

    .status-read {
        background: #E1F5E8;
        color: #237A43;
    }

            .status-processing {
            background: #DCEEFF;
            color: #1769AA;
        }

        .status-rejected {
            background: #FCE4E4;
            color: #B42318;
        }

    .notification-empty {
        background: #FFFFFF;
        border-radius: 14px;
        padding: 45px 20px;
        text-align: center;
        color: #888;
        box-shadow: 0 3px 12px rgba(0,0,0,0.05);
    }

    .notification-empty h5 {
        color: #820000;
        font-weight: 600;
        margin-bottom: 8px;
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

        @forelse ($notifikasi as $item)

            <div class="notification-card {{ !$item->status_baca ? 'unread' : '' }}">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">

                    <h6>{{ $item->judul }}</h6>

                    @php
                        $statusSponsor = $item->pengajuan->status ?? null;

                        $badgeStatus = [
                            'diajukan' => ['Diajukan', 'status-unread'],
                            'diproses' => ['Diproses', 'status-processing'],
                            'diterima' => ['Diterima', 'status-read'],
                            'ditolak' => ['Ditolak', 'status-rejected'],
                            'selesai' => ['Selesai', 'status-read'],
                        ];
                    @endphp

                    @if ($statusSponsor && isset($badgeStatus[$statusSponsor]))
                        <span class="notification-status {{ $badgeStatus[$statusSponsor][1] }}">
                            {{ $badgeStatus[$statusSponsor][0] }}
                        </span>
                    @endif

                </div>

                <p class="notification-message">
                    {{ $item->pesan }}
                </p>

                <span class="notification-date">
                    {{ $item->created_at
                        ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i')
                        : '-' }}
                </span>

            </div>

        @empty

            <div class="notification-empty">
                <h5>Belum Ada Notifikasi</h5>
                <p class="mb-0">
                    Notifikasi perkembangan pengajuan sponsor kamu
                    akan muncul di sini.
                </p>
            </div>

        @endforelse

    </div>
</section>

@endsection
