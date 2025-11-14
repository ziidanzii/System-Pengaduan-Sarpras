<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::orderBy('nama_lokasi', 'asc')->get();
        return view('admin.manajemen_lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        return view('admin.manajemen_lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:200|unique:lokasi,nama_lokasi',
        ]);

        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
        ]);

        return redirect()->route('admin.lokasi.index')
                         ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $lokasi = Lokasi::with('items')->findOrFail($id);
        $items = Item::all();

        // Daftar item yang sudah ada di lokasi
        $itemsInLocation = $lokasi->items()->pluck('items.id_item')->toArray();

        // Hitung item dalam lokasi
        $lokasi->items_count = $lokasi->items()->count();

        return view('admin.manajemen_lokasi.show', compact('lokasi', 'items', 'itemsInLocation'));
    }

    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        return view('admin.manajemen_lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $request->validate([
            'nama_lokasi' => 'required|string|max:200|unique:lokasi,nama_lokasi,' . $lokasi->id_lokasi . ',id_lokasi',
        ]);

        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
        ]);

        return redirect()->route('admin.lokasi.show', $lokasi->id_lokasi)
                         ->with('success', 'Lokasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        // Hapus relasi pivot
        DB::table('list_lokasi')->where('id_lokasi', $lokasi->id_lokasi)->delete();

        $lokasi->delete();

        return redirect()->route('admin.lokasi.index')
                         ->with('success', 'Lokasi berhasil dihapus');
    }

    public function addItem(Request $request, $lokasi)
    {
        $lokasiModel = Lokasi::findOrFail($lokasi);

        $request->validate([
            'id_item' => 'required|exists:items,id_item',
        ]);

        $exists = DB::table('list_lokasi')
            ->where('id_lokasi', $lokasiModel->id_lokasi)
            ->where('id_item', $request->id_item)
            ->exists();

        if ($exists) {
            return redirect()->route('admin.lokasi.show', $lokasiModel->id_lokasi)
                             ->with('error', 'Item sudah ada di lokasi ini');
        }

        DB::table('list_lokasi')->insert([
            'id_lokasi' => $lokasiModel->id_lokasi,
            'id_item' => $request->id_item,
        ]);

        return redirect()->route('admin.lokasi.show', $lokasiModel->id_lokasi)
                         ->with('success', 'Item berhasil ditambahkan ke lokasi');
    }

    public function removeItem($lokasi, $idItem)
    {
        $lokasiModel = Lokasi::findOrFail($lokasi);

        DB::table('list_lokasi')
            ->where('id_lokasi', $lokasiModel->id_lokasi)
            ->where('id_item', $idItem)
            ->delete();

        return redirect()->route('admin.lokasi.show', $lokasiModel->id_lokasi)
                         ->with('success', 'Item berhasil dihapus dari lokasi');
    }
}
