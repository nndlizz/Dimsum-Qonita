<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index() { return response()->json(Admin::latest()->get()); }
    public function create() { return response()->json(['message' => 'Form create admin']); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_admin' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:admin,email'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
        ]);
        $data['password'] = Hash::make($data['password']);
        return response()->json(Admin::create($data), 201);
    }
    public function show(Admin $admin) { return response()->json($admin); }
    public function edit(Admin $admin) { return response()->json($admin); }
    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'nama_admin' => ['sometimes', 'required', 'string', 'max:100'],
            'email' => ['sometimes', 'required', 'email', 'max:150', Rule::unique('admin', 'email')->ignore($admin->id_admin, 'id_admin')],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
        ]);
        if (isset($data['password'])) $data['password'] = Hash::make($data['password']);
        $admin->update($data);
        return response()->json($admin);
    }
    public function destroy(Admin $admin) { $admin->delete(); return response()->noContent(); }
}
