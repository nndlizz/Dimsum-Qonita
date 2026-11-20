@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div style="text-align: left;">
            <h3 class="h3 mb-1 text-gray-800">Kelola Akun Petugas</h3>
            <p class="text-muted small mb-0">Kelola daftar akun petugas Dimsum Qonita.</p>
        </div>

        <a href="{{ route('admin.akun.tambah') }}" class="btn text-white" style="background-color: #800000; border-color: #800000;">
            <i class="fas fa-plus"></i> + Tambah Akun
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold" style="color: #800000;">Daftar Akun Petugas</h4>
            </div>
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
                            @php
                                $defaultAvatar = asset('template_admin/assets/images/avatar.png');
                                $srcGambar = null;

                                if (!empty($admin->gambar)) {
                                    $rawGambar = ltrim($admin->gambar, '/');

                                    if (\Illuminate\Support\Str::startsWith($rawGambar, ['http://', 'https://'])) {
                                        $srcGambar = $rawGambar;
                                    } elseif (\Illuminate\Support\Str::startsWith($rawGambar, 'storage/')) {
                                        $srcGambar = asset($rawGambar);
                                    } elseif (str_contains($rawGambar, '/')) {
                                        $srcGambar = asset('storage/' . $rawGambar);
                                    } elseif (file_exists(public_path('uploads/admin/' . $rawGambar))) {
                                        $srcGambar = asset('uploads/admin/' . $rawGambar);
                                    } else {
                                        $srcGambar = asset('storage/admin-profiles/' . $rawGambar);
                                    }

                                    $ver = !empty($admin->updated_at) ? strtotime($admin->updated_at) : time();
                                    $srcGambar .= (str_contains($srcGambar, '?') ? '&' : '?') . 'v=' . $ver;
                                }
                            @endphp
                            <tr>
                                <td class="fw-bold">{{ $admin->nama_admin }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->nomor_hp ?? '-' }}</td>
                                <td>
                                    @if(strtolower($admin->status ?? '') == 'tidak aktif')
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @else
                                        <span class="badge bg-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($srcGambar))
                                        <img
                                            src="{{ $srcGambar }}"
                                            alt="Foto {{ $admin->nama_admin }}"
                                            width="40"
                                            height="40"
                                            class="rounded-circle object-fit-cover shadow-sm"
                                            onerror="this.onerror=null;this.src='{{ $defaultAvatar }}';"
                                        >
                                    @else
                                        <span class="text-muted small">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $admin->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $admin->alamat ?? '-' }}</td>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <a href="{{ route('admin.akun.edit', $admin->id_admin) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                            <!-- <i class="fas fa-edit"></i> -->
                                             <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.akun.hapus', $admin->id_admin) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin ingin menghapus akun ini?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#800000',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection