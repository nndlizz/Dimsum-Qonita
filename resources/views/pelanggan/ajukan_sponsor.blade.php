
@extends('pelanggan.layout.app')

@section('content')
<div class="container py-5">

    <h2>Form Pengajuan Sponsor</h2>
    <p>Silakan isi formulir pengajuan sponsorship berikut.</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="formAjukanSponsor"
          action="{{ route('pelanggan.sponsor.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan"
                   class="form-control"
                   value="{{ old('nama_kegiatan') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Penyelenggara</label>
            <input type="text" name="nama_penyelenggara"
                   class="form-control"
                   value="{{ old('nama_penyelenggara') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan"
                   class="form-control"
                   value="{{ old('tanggal_kegiatan') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi Kegiatan</label>
            <input type="text" name="lokasi_kegiatan"
                   class="form-control"
                   value="{{ old('lokasi_kegiatan') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Kegiatan</label>
            <textarea name="deskripsi"
                      class="form-control"
                      rows="4" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Proposal PDF</label>
            <input type="file" name="file_proposal"
                   class="form-control"
                   accept=".pdf" required>
            <small class="text-muted">Maksimal 5 MB.</small>
        </div>

        {{-- BUTTON AJUKAN --}}
        <button type="button"
                id="btnAjukan"
                class="btn btn-danger">
            <i class="bi bi-send me-1"></i>
            Ajukan Sponsor
        </button>

    </form>
</div>
@endsection

@section('scripts')
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const btn = document.getElementById('btnAjukan');
    const form = document.getElementById('formAjukanSponsor');

    if (!btn || !form) {
        console.log('Button atau form tidak ditemukan');
        return;
    }

    btn.addEventListener('click', function () {

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        Swal.fire({
            title: 'Ajukan Sponsor?',
            text: 'Pastikan data pengajuan sudah benar.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ajukan!',
            cancelButtonText: 'Periksa Lagi',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                form.requestSubmit();
            }
        });

    });

});
</script>
@endsection
@endsection