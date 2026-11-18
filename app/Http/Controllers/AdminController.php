<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index() 
    { 
        $admins = Admin::latest()->get();
        return view('admin.index', compact('admins')); // <- Variabel $cabangs tidak ada di sini!
    }

    public function create() 
    { 
        return view('admin.tambahakun'); 
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id); 
        return view('admin.edittambahakun', compact('admin'));
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->gambar && file_exists(public_path('uploads/admin/' . $admin->gambar))) {
            @unlink(public_path('uploads/admin/' . $admin->gambar));
        }

        $admin->delete();
        return redirect()->route('admin.akun.index')->with('success', 'Akun petugas berhasil dihapus!');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_admin'    => ['required', 'string', 'max:100'],
            'email'         => ['required', 'email', 'max:150', 'unique:admin,email'],
            'password'      => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
            'nomor_hp'      => ['nullable', 'string', 'max:20'],
            'status'        => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'string', 'max:50'],
            'alamat'        => ['nullable', 'string'],
            'gambar'        => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        
        $data['password'] = Hash::make($data['password']);
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/admin'), $filename);
            $data['gambar'] = $filename;
        }
        
        Admin::create($data);
        return redirect()->route('admin.akun.index')->with('success', 'Akun petugas berhasil ditambahkan!');
    }

    public function show(Admin $admin) { return response()->json($admin); }

    public function update(Request $request)
    {
        // Ambil data admin yang sedang login (sesuaikan dengan session/Auth project kalian)
        $id = session('admin_id'); // atau Auth::id() tergantung yang kalian pakai
        $admin = Admin::findOrFail($id);

        $admin->nama_admin = $request->nama_admin;
        $admin->nomor_hp = $request->nomor_hp;
        $admin->jenis_kelamin = $request->jenis_kelamin;
        $admin->alamat = $request->alamat;

        // Jika password diisi
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // 👈 PASTIKAN PENANGANAN FOTO INI ADA DI ADMIN PROFILE CONTROLLER JUGA
        if ($request->hasFile('gambar')) {
            // Hapus foto lama jika ada di folder uploads/admin
            if ($admin->gambar && file_exists(public_path('uploads/admin/' . $admin->gambar))) {
                @unlink(public_path('uploads/admin/' . $admin->gambar));
            }

            // Simpan ke folder yang SAMA (uploads/admin)
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/admin'), $filename);
            $admin->gambar = $filename;
        }

        $admin->save();

        return redirect()->route('admin.akun.index')->with('success', 'Profil berhasil diperbarui!');
    }
    }