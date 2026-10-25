
@extends('admin.layout')

@section('content')

<style>
    .edit-profile-page {
        background: #f9f9f9;
        color: #212529;
        padding: 20px;
        border-radius: 12px;
    }

    .edit-profile-page .page-title,
    .edit-profile-page h5 {
        color: #212529;
        font-weight: 700;
    }

    .edit-profile-page .page-subtitle,
    .edit-profile-page .breadcrumb-item a {
        color: #6c757d;
    }

    .edit-profile-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
    }

    .edit-profile-page .form-label {
        color: #212529;
        font-weight: 600;
        font-size: 14px;
    }

    .edit-profile-page .form-control,
    .edit-profile-page .form-select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 10px 12px;
    }

    .edit-profile-page .form-control:focus,
    .edit-profile-page .form-select:focus {
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
        transition: background .2s ease;
    }

    .btn-profile-cancel:hover {
        background: #f9f9f9;
        color: #9A0000;
        border-color: #9A0000;
    }

    @media (max-width: 576px) {
        .edit-profile-page {
            padding: 12px;
        }
    }
</style>

<div class="edit-profile-page">
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Edit Profil Admin</h1>
            <p class="page-subtitle">Perbarui informasi akun.</p>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.profil') }}"
                       class="text-decoration-none">Profil Admin</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Profil
                </li>
            </ol>
        </nav>
    </div>

    <div class="card edit-profile-card p-4">
        <h5 class="mb-3">
            <i class="bi bi-person-gear me-2"></i>Informasi Pengguna
        </h5>

        <hr>

        <form action="{{ route('admin.profil.update') }}"
              method="POST"
              enctype="multipart/form-data"
              id="editProfileForm"
              novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_admin" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama_admin" name="nama_admin"
                       class="form-control"
                       value="{{ old('nama_admin', $admin->nama_admin) }}"
                       required>
                @error('nama_admin')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email"
                       class="form-control"
                       value="{{ old('email', $admin->email) }}"
                       required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Nomor HP</label>
                <input type="text" id="nomor_hp" name="nomor_hp"
                       class="form-control"
                       value="{{ old('nomor_hp', $admin->nomor_hp) }}">
                @error('nomor_hp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">
                    Jenis Kelamin
                </label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                        class="form-select">
                    <option value="">Pilih jenis kelamin</option>
                    <option value="Laki-laki"
                        {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
                @error('jenis_kelamin')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"
                          class="form-control">{{ old('alamat', $admin->alamat) }}</textarea>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Foto Profil</label>

                @if(!empty($admin->gambar))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $admin->gambar) }}"
                             alt="Foto profil saat ini"
                             style="width:70px;height:70px;object-fit:cover;border-radius:50%;border:2px solid #dee2e6;">
                    </div>
                @endif

                <input type="file" id="gambar" name="gambar"
                       class="form-control"
                       accept=".jpg,.jpeg,.png,.webp">

                <small class="text-muted">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                </small>

                @error('gambar')
                    <small class="text-danger d-block">{{ $message }}</small>
                @enderror
            </div>

            <hr class="mt-4">

            <div class="d-flex flex-wrap justify-content-end gap-2">
                <a href="{{ route('admin.profil') }}"
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

    // Menampilkan error validasi dari Laravel
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

        const nama = document.getElementById('nama_admin').value.trim();
        const email = document.getElementById('email').value.trim();
        const nomorHp = document.getElementById('nomor_hp').value.trim();
        const jenisKelamin = document.getElementById('jenis_kelamin').value;
        const gambarInput = document.getElementById('gambar');
        const gambar = gambarInput.files[0];

        let pesan = '';

        if (!nama) {
            pesan = 'Nama lengkap wajib diisi.';
        } else if (nama.length > 255) {
            pesan = 'Nama lengkap maksimal 255 karakter.';
        } else if (!email) {
            pesan = 'Email wajib diisi.';
        } else if (email.length > 255 ||
                   !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            pesan = 'Format email tidak valid. Contoh: nama@email.com';
        } else if (nomorHp &&
                   !/^[0-9+\-\s()]+$/.test(nomorHp)) {
            pesan = 'Nomor HP hanya boleh berisi angka dan simbol nomor telepon.';
        } else if (nomorHp.length > 20) {
            pesan = 'Nomor HP maksimal 20 karakter.';
        } else if (gambar) {
            const formatValid = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ].includes(gambar.type);

            if (!formatValid) {
                pesan = 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.';
            } else if (gambar.size > 2 * 1024 * 1024) {
                pesan = 'Ukuran foto maksimal 2 MB.';
            }
        }

        if (!pesan && jenisKelamin &&
            !['Laki-laki', 'Perempuan'].includes(jenisKelamin)) {
            pesan = 'Silakan pilih jenis kelamin yang valid.';
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
            cancelButtonColor: '#f8e89b'
        }).then(function (result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection
