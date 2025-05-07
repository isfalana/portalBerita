<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = Kategori::all();
        $query = Berita::query();

        // Filter berdasarkan pencarian judul
        if ($request->filled('search')) {
            $query->where('judul_berita', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $beritas = $query->latest()->paginate(9)->withQueryString(); // dengan withQueryString agar pagination membawa parameter
        $mostViewed = Berita::orderBy('total_views', 'desc')->take(5)->get();

        return view('home', compact('beritas', 'kategoriList', 'mostViewed'));
    }
}
