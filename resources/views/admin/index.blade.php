@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div style="text-align: left;">
            <h3 class="h3 mb-1 text-gray-800">Kelola Akun Petugas</h3>
            <p class="text-muted small mb-0">Kelola daftar akun petugas Dimsum Qonita.</p>
        </div>
        
        <a href="{{ route('admin.akun.tambah') }}" class="btn btn-success">
            <span style="font-weight: bold; font-size: 1.1em; margin-right: 4px;">+</span> Tambah Akun
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table align-middle table-hover text-center">
        </table>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Akun Petugas</h4>
        </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover text-center">
                    <thead>
                        <tr class="align-middle">
                            <th>Nama Petugas</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td class="fw-bold">{{ $admin->nama_admin }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->nomor_hp ?? '-' }}</td>
                            <td>
                                <span class="badge bg-success">{{ $admin->status ?? 'Aktif' }}</span>
                            </td>
                            <td>
                                @if($admin->gambar)
                                    <img src="{{ asset('uploads/admin/' . $admin->gambar) }}" alt="Foto" width="40" height="40" class="rounded-circle object-fit-cover shadow-sm">
                                @else
                                    <span class="text-muted small">Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $admin->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $admin->alamat ?? '-' }}</td>
                            
                            <!-- Kolom Aksi -->
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    <a href="{{ route('admin.akun.edit', $admin->id_admin) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.akun.hapus', $admin->id_admin) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus akun ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection