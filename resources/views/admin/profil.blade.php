
@extends('admin.layout')

@section('content')

<style>
    .profile-page {
        background: transparent;
        color: #212529;
        padding: 20px;
        border-radius: 12px;
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

    .profile-avatar,
    .profile-avatar-default {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        border: 2px solid #dee2e6;
    }

    .profile-avatar {
        object-fit: cover;
    }

    .profile-avatar-default {
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

    /* Tombol Edit Profil mengikuti warna login */
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
</style>

<div class="profile-page">
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Profil Admin</h1>
            <p class="page-subtitle">Informasi akun admin.</p>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-decoration-none">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Profil Admin
                </li>
            </ol>
        </nav>
    </div>

    <div class="card profile-card p-4">
        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
            @if(!empty($admin->gambar))
                <img
                    src="{{ asset('storage/' . $admin->gambar) }}"
                    alt="Foto profil admin"
                    class="profile-avatar"
                >
            @else
                <div class="profile-avatar-default">
                    <i class="bi bi-person-fill"></i>
                </div>
            @endif

            <div>
                <h4 class="profile-name mb-1">
                    {{ $admin->nama_admin }}
                </h4>
                <p class="mb-0 text-secondary">
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
                    {{ $admin->nama_admin ?: '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-label">Email</div>
                <div class="profile-value">
                    {{ $admin->email ?: '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-label">Nomor HP</div>
                <div class="profile-value">
                    {{ $admin->nomor_hp ?: '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-label">Jenis Kelamin</div>
                <div class="profile-value">
                    {{ $admin->jenis_kelamin ?: '-' }}
                </div>
            </div>

            <div class="col-12">
                <div class="profile-label">Alamat</div>
                <div class="profile-value">
                    {{ $admin->alamat ?: '-' }}
                </div>
            </div>
        </div>

        <hr class="mt-4">

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.profil.edit') }}"
               class="btn-profile-edit">
                <i class="bi bi-pencil-square me-1"></i>
                Edit Profil
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
