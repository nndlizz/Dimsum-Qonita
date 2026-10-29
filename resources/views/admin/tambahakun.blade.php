@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 font-weight-bold text-dark">Tambah Akun Petugas</h1>
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
            <form action="{{ route('admin.akun.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nama Petugas</label>
                    <input type="text" name="nama_admin" class="form-control" value="{{ old('nama_admin') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp') }}" placeholder="Contoh: 081234567890">
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <!-- Gambar bersifat Opsional -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Gambar / Foto Profil (Opsional)</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn text-white px-4" style="background-color: #800000; border-color: #800000;">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection