<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(9); // berita terbaru
        $mostViewed = Berita::orderBy('total_views', 'desc')->take(5)->get(); // berita terbanyak dilihat

        return view('home', compact('beritas', 'mostViewed'));
    }

}
