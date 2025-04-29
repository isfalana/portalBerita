<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalKategori = Kategori::count();
        $latestNews = Berita::latest()->take(5)->get();

        return view('dashboard', compact('totalBerita', 'totalKategori', 'latestNews'));
    }
}
