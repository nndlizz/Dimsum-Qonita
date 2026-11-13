<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AjukanSponsor;

class SponsorController extends Controller
{
//    public function create()
//     {
//         return view('pelanggan.ajukan_sponsor');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'nama_kegiatan' => 'required|string|max:255',
//             'nama_penyelenggara' => 'required|string|max:255',
//             'tanggal_kegiatan' => 'required|date|after_or_equal:today',
//             'lokasi_kegiatan' => 'required|string|max:255',
//             'deskripsi' => 'required|string',
//             'file_proposal' => 'required|mimes:pdf|max:5120',
//         ]);

//         $file = $request->file('file_proposal')
//             ->store('proposal', 'public');

//         AjukanSponsor::create([
//             'id_pelanggan' => session('id_pelanggan'),
//             'nama_kegiatan' => $request->nama_kegiatan,
//             'nama_penyelenggara' => $request->nama_penyelenggara,
//             'tanggal_kegiatan' => $request->tanggal_kegiatan,
//             'lokasi_kegiatan' => $request->lokasi_kegiatan,
//             'deskripsi' => $request->deskripsi,
//             'file_proposal' => $file,
//             'status' => 'diajukan',
//         ]);

//         return redirect()
//             ->route('pelanggan.sponsor.create')
//             ->with('success', 'Pengajuan sponsor berhasil dikirim!');
//     }
}
