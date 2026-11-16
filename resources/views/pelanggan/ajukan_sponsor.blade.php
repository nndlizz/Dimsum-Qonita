
@extends('pelanggan.layout.app')

@section('content')
<div class="container py-5">

    <h2>Form Pengajuan Sponsor</h2>
    <p>Silakan isi formulir pengajuan sponsorship berikut.</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.sponsor.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Penyelenggara</label>
            <input type="text" name="nama_penyelenggara"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lokasi Kegiatan</label>
            <input type="text" name="lokasi_kegiatan"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi Kegiatan</label>
            <textarea name="deskripsi"
                      class="form-control"
                      rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Proposal PDF</label>
            <input type="file" name="file_proposal"
                   class="form-control"
                   accept=".pdf" required>
            <small>Maksimal 5 MB.</small>
        </div>

        <button type="submit" class="btn btn-primary">
            Ajukan Sponsor
        </button>
            <script>
                document.getElementById('btnAjukan').addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Ajukan Sponsor?',
                        text: 'Pastikan data pengajuan sudah benar.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Ajukan!',
                        cancelButtonText: 'Periksa Lagi',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    });
                });
                </script>
                @if(session('success'))
                <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                </script>
                @endif
                @if($errors->any())
                <script>
                Swal.fire({
                    title: 'Oops!',
                    text: @json($errors->first()),
                    icon: 'error',
                    confirmButtonText: 'Mengerti'
                });
                </script>
            @endif
        

    </form>
</div>
@endsection
