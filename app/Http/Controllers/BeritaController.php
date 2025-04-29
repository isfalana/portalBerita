<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;

class BeritaController extends Controller
{
    //
    public function index(){
        $berita = Berita::with('kategori')->get();
        return view('berita.list', compact('berita'));
    }
    public function tambah() {
        $kategori = Kategori::all();
        // dd($kategori);
        return view('berita.tambah', compact('kategori'));
    }
    
    
    public function prosesTambah(Request $request) {
        // dd($request->all());
        $request->validate([
            'judul' => 'required',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi' => 'required',
        ]);
    
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }
    
        Berita::create([
            'judul_berita' => $request->judul,
            'id_kategori' => $request->id_kategori,
            'gambar_berita' => $gambarPath,
            'isi_berita' => $request->isi,
        ]);
    
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }
    
    
    public function ubah($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('berita.ubah', compact('berita', 'kategori'));
    }

    public function prosesUbah(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        // Jika input kosong, ambil dari data lama
        $judul = $request->filled('judul') ? $request->judul : $berita->judul_berita;
        $kategori = $request->filled('id_kategori') ? $request->id_kategori : $berita->id_kategori;
        $isi = $request->filled('isi') ? $request->isi : $berita->isi_berita;
        $gambar = $berita->gambar_berita;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update([
            'judul_berita' => $judul,
            'id_kategori' => $kategori,
            'isi_berita' => $isi,
            'gambar_berita' => $gambar,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }
    
    public function hapus($id) {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        // Tambahkan view
        $berita->increment('total_views');

        return view('detailberita', compact('berita'));
    }
    
}
