<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    public function index() {
        $kategori = Kategori::all();
        return view('kategori.list', [
            'kategori' => $kategori,
            'title' => 'Admin/Kategori'
        ]);
    }
    
    public function tambah() {
        return view('kategori.tambah', ['title' => 'Admin/Kategori']);
    }
    
    public function prosesTambah(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
    
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
    
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    
    public function ubah($id) {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.ubah', ['kategori' => $kategori, 'title' => 'Admin/Kategori']);
    }
    
    public function prosesUbah(Request $request, $id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah');
    }

    public function hapus($id) {
        Kategori::findOrFail($id)->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
