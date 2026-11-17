
@extends('pelanggan.layout.app')

@section('hideNavbar', true)
@section('hideFooter', true)

@section('content')

<style>
    .edit-profile-page {
        background: #FFF4E5;
        color: #212529;
        padding: 20px;
        border-radius: 12px;
        min-height: 100vh;
    }

    .edit-profile-page .page-title,
    .edit-profile-page h5 {
        color: #212529;
        font-weight: 700;
    }

    .edit-profile-page .page-subtitle {
        color: #6c757d;
    }

    .edit-profile-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
    }

    .edit-profile-page .form-label {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .edit-profile-page .form-control {
        color: #212529;
        font-weight: 600;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 10px 12px;
    }

    .edit-profile-page .form-control:focus {
        border-color: #820000;
        box-shadow: 0 0 0 .2rem rgba(130, 0, 0, .12);
    }

    .edit-profile-page hr {
        border-color: #dee2e6;
        opacity: 1;
    }

    .btn-profile-save {
        background: #820000;
        color: #fff;
        border: 1px solid #820000;
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 600;
        transition: background .2s ease;
    }

    .btn-profile-save:hover {
        background: #9A0000;
        border-color: #9A0000;
        color: #fff;
    }

    .btn-profile-cancel {
        background: #fff;
        color: #820000;
        border: 1px solid #820000;
        border-radius: 8px;
        padding: 10px 18px;
        text-decoration: none;
        font-weight: 600;
        transition: background .2s ease;
    }

    .btn-profile-cancel:hover {
        background: #f9f9f9;
        color: #9A0000;
        border-color: #9A0000;
    }

    body {
        background-color: #FFF4E5 !important;
    }

    @media (max-width: 576px) {
        .edit-profile-page {
            padding: 12px;
        }
    }
</style>

<div class="edit-profile-page">

    <!-- Tombol Kembali -->
    <div class="mb-3">
        <a href="{{ route('pelanggan.profil') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <!-- Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Edit Profil Saya</h1>
            <p class="page-subtitle">
                Perbarui informasi akun pelanggan.
            </p>
        </div>
    </div>

    <!-- Card Informasi Pengguna -->
    <div class="card edit-profile-card p-4">

        <h5 class="mb-3">
            <i class="bi bi-person-gear me-2"></i>
            Informasi Pengguna
        </h5>

        <hr>

        <form action="{{ route('pelanggan.profil.update') }}"
              method="POST"
              id="editProfileForm"
              novalidate>

            @csrf
            @method('PUT')

            <div class="row g-4">


                <div class="col-md-6">
                    <label for="nama_pelanggan" class="form-label">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           id="nama_pelanggan"
                           name="nama_pelanggan"
                           class="form-control"
                           value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}"
                           maxlength="255"
                           required>

                    @error('nama_pelanggan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $pelanggan->email) }}"
                           maxlength="255"
                           required>

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="no_telepon" class="form-label">
                        Nomor WhatsApp / HP
                    </label>

                    <input type="text"
                           id="no_telepon"
                           name="no_telepon"
                           class="form-control"
                           value="{{ old('no_telepon', $pelanggan->no_telepon) }}"
                           maxlength="20"
                           required>

                    @error('no_telepon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


<!-- Bagian Ubah Password -->
<div class="col-12">
    <hr class="mt-3">

    <h5 class="mb-3">
        <i class="bi bi-lock me-2"></i>
        Ubah Password
    </h5>

    <p class="text-secondary small">
        Kosongkan jika tidak ingin mengubah password.
    </p>
</div>

<div class="col-md-6">
    <label for="password_lama" class="form-label">
        Password Lama
    </label>

    <input type="password"
           id="password_lama"
           name="password_lama"
           class="form-control"
           autocomplete="current-password">

    @error('password_lama')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-6">
    <label for="password_baru" class="form-label">
        Password Baru
    </label>

    <input type="password"
           id="password_baru"
           name="password_baru"
           class="form-control"
           minlength="8"
           autocomplete="new-password">

    @error('password_baru')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-6">
    <label for="password_baru_confirmation" class="form-label">
        Konfirmasi Password Baru
    </label>

    <input type="password"
           id="password_baru_confirmation"
           name="password_baru_confirmation"
           class="form-control"
           minlength="8"
           autocomplete="new-password">
</div>


            </div>

            <hr class="mt-4">

            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a href="{{ route('pelanggan.profil') }}"
                   class="btn-profile-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-profile-save">
                    <i class="bi bi-check-circle me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('editProfileForm');

    if (!form) return;

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Data Tidak Valid!',
            text: @json($errors->first()),
            confirmButtonColor: '#820000',
            confirmButtonText: 'Periksa Kembali'
        });
    @endif

    form.addEventListener('submit', function (event) {

        event.preventDefault();

        const nama = document.getElementById('nama_pelanggan').value.trim();
        const email = document.getElementById('email').value.trim();
        const noTelepon = document.getElementById('no_telepon').value.trim();

        let pesan = '';

        if (!nama) {
            pesan = 'Nama lengkap wajib diisi.';
        } else if (nama.length > 255) {
            pesan = 'Nama lengkap maksimal 255 karakter.';
        } else if (!email) {
            pesan = 'Email wajib diisi.';
        } else if (
            email.length > 255 ||
            !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
        ) {
            pesan = 'Format email tidak valid. Contoh: nama@email.com';
        } else if (!noTelepon) {
            pesan = 'Nomor WhatsApp/HP wajib diisi.';
        } else if (!/^[0-9+\-\s()]+$/.test(noTelepon)) {
            pesan = 'Nomor HP hanya boleh berisi angka dan simbol nomor telepon.';
        } else if (noTelepon.length > 20) {
            pesan = 'Nomor HP maksimal 20 karakter.';
        }

        if (pesan) {
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Valid!',
                text: pesan,
                confirmButtonColor: '#820000',
                confirmButtonText: 'Periksa Kembali'
            });

            return;
        }

        Swal.fire({
            icon: 'question',
            title: 'Simpan Perubahan?',
            text: 'Pastikan informasi profil sudah benar.',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Periksa Lagi',
            confirmButtonColor: '#820000',
            cancelButtonColor: '#6c757d'
        }).then(function (result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });

});
</script>

@endsection