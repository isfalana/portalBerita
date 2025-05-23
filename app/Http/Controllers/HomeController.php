<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = Kategori::all();
        $query = Berita::query();

         $externalNews = [];
        try {
            $response = Http::get('https://newsapi.org/v2/top-headlines', [
                'country' => 'us',
                'apiKey' => env('NEWS_API_KEY'),
            ]);

            if ($response->successful()) {
                $externalNews = $response->json('articles');
            }
        } catch (\Exception $e) {
            // Log error jika terjadi
            \Log::error('Gagal memuat berita dari API: ' . $e->getMessage());
        }

        // Filter berdasarkan pencarian judul
        if ($request->filled('search')) {
            $query->where('judul_berita', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $beritas = $query->latest()->paginate(9)->withQueryString(); // dengan withQueryString agar pagination membawa parameter
        $mostViewed = Berita::orderBy('total_views', 'desc')->get();

        return view('home', compact('beritas', 'kategoriList', 'mostViewed', 'externalNews'));
    }
}
