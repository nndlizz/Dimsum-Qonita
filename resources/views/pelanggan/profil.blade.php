@extends('pelanggan.layout.app')
@section('hideNavbar', true)
@section('hideFooter', true)

@section('content')

<style>
    .profile-page {
    background: #FFF4E5;
    color: #212529;
    padding: 20px;
    border-radius: 12px;
    min-height: 100vh;
}

    .profile-page .page-title,
    .profile-name {
        color: #212529;
        font-weight: 700;
    }

    .page-subtitle,
    .profile-label,
    .breadcrumb-item a {
        color: #6c757d;
    }

    .profile-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
    }

    .profile-avatar-default {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        border: 2px solid #dee2e6;
        background: #f8f9fa;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .profile-label {
        font-size: 13px;
        margin-bottom: 5px;
    }

    .profile-value {
        color: #212529;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .profile-page hr {
        border-color: #dee2e6;
        opacity: 1;
    }

    /* Tombol Edit Profil */
    .btn-profile-edit {
        background: #820000;
        color: #fff;
        border: 1px solid #820000;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background .2s ease;
    }

    .btn-profile-edit:hover {
        background: #9A0000;
        border-color: #9A0000;
        color: #fff;
    }

    @media (max-width: 576px) {
        .profile-page {
            padding: 12px;
        }
    }

    body {
    background-color: #FFF4E5 !important;
}
</style>

<div class="profile-page">
    <div class="mb-3">
    <div class="mb-3">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Kembali
    </a>
</div>
</div>

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Profil Saya</h1>
            <p class="page-subtitle">Informasi akun pelanggan.</p>
        </div>
    </div>

    <div class="card profile-card p-4">

        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">

            <div>
                <h4 class="profile-name mb-1">
                    {{ $pelanggan->nama_pelanggan }}
                </h4>
                <p class="mb-0 text-secondary">
                    Pelanggan Qonita Foodstore
                </p>
            </div>

        </div>

        <hr>

        <h5 class="mb-3">
            <i class="bi bi-person-lines-fill me-2"></i>
            Informasi Pengguna
        </h5>

        <div class="row g-4">

            <div class="col-md-6">
                <div class="profile-label">Nama Lengkap</div>
                <div class="profile-value">
                    {{ $pelanggan->nama_pelanggan ?: '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-label">Email</div>
                <div class="profile-value">
                    {{ $pelanggan->email ?: '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-label">Nomor WhatsApp / HP</div>
                <div class="profile-value">
                    {{ $pelanggan->no_telepon ?: '-' }}
                </div>
            </div>

        </div>

        <hr class="mt-4">

        <div class="d-flex justify-content-end">
            <a href="{{ route('pelanggan.profil.edit') }}"
               class="btn-profile-edit">
                <i class="bi bi-pencil-square me-1"></i>
                Ubah Profil
            </a>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            confirmButtonColor: '#820000'
        });
    @endif
});
</script>

@endsection