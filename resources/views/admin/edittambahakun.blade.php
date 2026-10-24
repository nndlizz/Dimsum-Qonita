@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 font-weight-bold text-dark">Ubah Akun Petugas</h1>
        <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary px-4">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Form Edit menggunakan method PUT dan enctype untuk upload file -->
            <form action="{{ route('admin.akun.update', $admin->id_admin) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nama Petugas</label>
                    <input type="text" name="nama_admin" class="form-control" value="{{ old('nama_admin', $admin->nama_admin) }}" required>
                </div>

                <div class="mb-3"><label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $admin->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $admin->nomor_hp) }}" placeholder="Contoh: 081234567890">
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                    <small class="text-muted">Password harus memiliki minimal 8 karakter dan mengandung huruf besar, huruf kecil, angka, dan karakter spesial.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif" {{ old('status', $admin->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status', $admin->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <!-- Gambar / Foto Profil -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Gambar / Foto Profil (Opsional)</label>
                    @if($admin->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/admin/' . $admin->gambar) }}" alt="Foto Lama" width="60" height="60" class="rounded-circle" style="object-fit: cover;">
                            <span class="text-muted ms-2" style="font-size: 0.9rem;">Foto saat ini</span>
                        </div>
                    @endif
                    <input type="file" name="gambar" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $admin->alamat) }}</textarea>
                </div>

                <button type="submit" class="btn text-white w-100 py-2 font-weight-bold" style="background-color: #2d6a4f; border: none;">
                    Perbarui Akun Petugas
                </button>
            </form>
        </div>
    </div>
</div>
@endsection