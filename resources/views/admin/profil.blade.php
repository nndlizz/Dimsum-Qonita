
@extends('admin.layout')

@section('content')

    <!-- Header Halaman -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Profil Admin</h1>
            <p class="page-subtitle">
                Kelola informasi akun admin GoDimsum.
            </p>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}"
                       class="text-decoration-none text-muted-green">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active text-main"
                    aria-current="page">
                    Profil Admin
                </li>
            </ol>
        </nav>
    </div>

    <!-- Informasi Profil -->
    <div class="card border-light shadow-sm p-4">

        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
            <div>
                @if(!empty($admin->gambar))
                    <img
                        src="{{ asset('storage/' . $admin->gambar) }}"
                        alt="Foto profil admin"
                        class="rounded-circle border"
                        style="width: 90px; height: 90px; object-fit: cover;"
                    >
                @else
                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 90px; height: 90px; background: #eef5d8; color: #66852d; font-size: 38px;"
                    >
                        <i class="bi bi-person-circle"></i>
                    </div>
                @endif
            </div>

            <div>
                <h4 class="mb-1">{{ $admin->nama_admin }}</h4>
                <p class="text-muted-green mb-0">
                </p>
            </div>
        </div>

        <hr>

        <form
            id="profile-form"
            action="{{ route('admin.profil.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <!-- Foto Profil -->
            <div class="mb-4">
                <label for="gambar" class="form-label">
                    Foto Profil
                </label>

                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    class="form-control @error('gambar') is-invalid @enderror"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="text-muted">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                </small>

                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama_admin" class="form-label">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama_admin"
                    name="nama_admin"
                    class="form-control @error('nama_admin') is-invalid @enderror"
                    value="{{ old('nama_admin', $admin->nama_admin) }}"
                    maxlength="255"
                    required
                >

                @error('nama_admin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $admin->email) }}"
                    maxlength="255"
                    required
                >

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor HP -->
            <div class="mb-3">
                <label for="nomor_hp" class="form-label">
                    Nomor HP
                </label>

                <input
                    type="tel"
                    id="nomor_hp"
                    name="nomor_hp"
                    class="form-control @error('nomor_hp') is-invalid @enderror"
                    value="{{ old('nomor_hp', $admin->nomor_hp ?? '') }}"
                    maxlength="20"
                    placeholder="Masukkan nomor HP"
                >

                @error('nomor_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">
                    Jenis Kelamin
                </label>

                <select
                    id="jenis_kelamin"
                    name="jenis_kelamin"
                    class="form-select @error('jenis_kelamin') is-invalid @enderror"
                >
                    <option value="">Pilih jenis kelamin</option>

                    <option
                        value="Laki-laki"
                        {{ old('jenis_kelamin', $admin->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}
                    >
                        Laki-laki
                    </option>

                    <option
                        value="Perempuan"
                        {{ old('jenis_kelamin', $admin->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}
                    >
                        Perempuan
                    </option>
                </select>

                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="form-label">Alamat</label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                    maxlength="1000"
                    class="form-control @error('alamat') is-invalid @enderror"
                    placeholder="Masukkan alamat"
                >{{ old('alamat', $admin->alamat ?? '') }}</textarea>

                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-outline-secondary"
                >
                    Batal
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-1"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <!-- Notifikasi SweetAlert2 -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    confirmButtonColor: '#66852d'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Data tidak valid!',
                    text: @json($errors->first()),
                    confirmButtonColor: '#66852d'
                });
            @endif
        });
    </script>

@endsection
