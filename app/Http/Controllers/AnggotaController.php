<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::where('is_admin', false) // bukan admin
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.anggota.index', compact('anggota'));
    }

    public function show($id)
    {
        $anggota = User::where('is_admin', false)->findOrFail($id);
        return view('admin.anggota.detail', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users',
            'notelp'   => 'nullable',
            'email'    => 'nullable|email|unique:users',
            'password' => 'required|min:6',
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $photo = null;
        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'notelp'   => $request->notelp,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo' => $photo,
            'is_admin' => false,
            'google_id' => null,
        ]);

        return redirect('/anggotaadmin')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $anggota = User::where('is_admin', false)->findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = User::where('is_admin', false)->findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users,username,' . $anggota->id,
            'email'    => 'nullable|email|unique:users,email,' . $anggota->id,
            'notelp'   => 'nullable',
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $anggota->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'notelp'   => $request->notelp,
        ]);

        if ($request->password) {
            $anggota->update([
                'password' => Hash::make($request->password)
            ]);
        }

        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo')->store('profile_photos', 'public');
            $anggota->update(['profile_photo' => $photo]);
        }

        return redirect('/anggotaadmin')->with('success', 'Data anggota diperbarui');
    }

    public function destroy($id)
    {
        User::where('is_admin', false)->where('id', $id)->delete();
        return redirect('/anggotaadmin')->with('success', 'Anggota berhasil dihapus');
    }
}
