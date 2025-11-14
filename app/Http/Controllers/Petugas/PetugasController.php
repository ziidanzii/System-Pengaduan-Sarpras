<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    // Tampilkan semua petugas
    public function index()
    {
        $petugas = Petugas::with('user')->get();
        return view('admin.manajemen_petugas.index', compact('petugas'));
    }

    // Method create untuk route resource
    public function create()
    {
        // Panggil createComplete
        return $this->createComplete();
    }

    // Form tambah petugas + user
    public function createComplete()
    {
        return view('admin.manajemen_petugas.create');
    }

    // Method store untuk route resource
    public function store(Request $request)
    {
        // Panggil storeComplete
        return $this->storeComplete($request);
    }

    // Simpan petugas + user baru
    public function storeComplete(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:200',
            'gender' => 'required|in:P,L',
            'telp' => 'required|string|max:30',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::transaction(function() use ($request) {
            // Buat user baru
            $user = User::create([
                'nama_pengguna' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'petugas',
            ]);

            // Buat data petugas
            Petugas::create([
                'nama' => $request->nama,
                'gender' => $request->gender,
                'telp' => $request->telp,
                'id_user' => $user->id,
            ]);
        });

        return redirect()->route('admin.petugas.index')
                         ->with('success', 'Petugas berhasil dibuat!');
    }

    // Form edit petugas
    public function edit($id)
    {
        $petugas = Petugas::with('user')->findOrFail($id);
        return view('admin.manajemen_petugas.edit', compact('petugas'));
    }

    // Update petugas + user
    public function update(Request $request, $id)
    {
        $petugas = Petugas::with('user')->findOrFail($id);

        // DEBUG: lihat payload request sementara — hapus setelah debugging
        dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:200',
            'gender' => 'required|in:P,L',
            'telp' => 'required|string|max:30',
            'username' => 'required|unique:users,username,' . $petugas->id_user,
            'email' => 'required|email|unique:users,email,' . $petugas->id_user,
            'password' => 'nullable|min:6|confirmed',
        ]);

        DB::transaction(function() use ($request, $petugas) {
            // Update user
            $user = $petugas->user;
            $user->nama_pengguna = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update petugas
            $petugas->nama = $request->nama;
            $petugas->gender = $request->gender;
            $petugas->telp = $request->telp;
            $petugas->save();
        });

        return redirect()->route('admin.petugas.index')
                         ->with('success', 'Petugas berhasil diperbarui!');
    }

    // Hapus petugas + user
    public function destroy(Petugas $petugas)
    {
        DB::transaction(function() use ($petugas) {
            $petugas->user()->delete();
            $petugas->delete();
        });

        return redirect()->route('admin.petugas.index')
                         ->with('success', 'Petugas berhasil dihapus!');
    }
}
