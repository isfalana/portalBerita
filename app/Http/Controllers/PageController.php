<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\Page;


class PageController extends Controller
{
    public function index() {
        $page = Page::all();
        return view('page.list', compact('page'))->with('title', 'Admin/Page');
    }

    public function tambah() {
        return view('page.tambah', ['title' => 'Tambah Page']);
    }

    public function prosesTambah(Request $request) {
        $request->validate([
            'judul_page' => 'required|string|max:255',
            'isi_page' => 'nullable|string',
            'status_page' => 'required|in:0,1',
        ]);

        Page::create($request->all());

        return redirect()->route('page.index')->with('success', 'Page berhasil ditambahkan.');
    }

    public function ubah($id) {
        $page = Page::findOrFail($id);
        return view('page.ubah', compact('page'))->with('title', 'Ubah Page');
    }

    public function prosesUbah(Request $request, $id) {
        $request->validate([
            'judul_page' => 'required|string|max:255',
            'isi_page' => 'nullable|string',
            'status_page' => 'required|in:0,1',
        ]);

        $page = Page::findOrFail($id);
        $page->update($request->all());

        return redirect()->route('page.index')->with('success', 'Page berhasil diubah.');
    }

    public function hapus($id) {
        Page::findOrFail($id)->delete();
        return redirect()->route('page.index')->with('success', 'Page berhasil dihapus.');
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        $rekomendasi = Berita::where('id_berita', '!=', $id)->latest()->get();

        return view('page.detail', compact('page', 'rekomendasi'));
    }

}
