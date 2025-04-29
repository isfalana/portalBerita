<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Buat query untuk menu
        $query = Menu::query();

        // Jika ada keyword dari form search
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_menu', 'like', '%' . $request->search . '%')
                ->orWhere('url_menu', 'like', '%' . $request->search . '%');
        }

        // Ambil semua menu yang diurutkan berdasarkan urutan_menu
        $menus = $query->orderBy('urutan_menu', 'asc')->get();

        // Return ke tampilan dengan variabel menus
        return view('menu.list', compact('menus'))->with('title', 'List Menu');
    }



    public function tambah()
    {
        $pages = Page::all();  // ambil semua page (untuk jenis page)
        $menus = Menu::orderBy('urutan_menu', 'asc')->get(); // ambil semua menu untuk parent menu

        return view('menu.tambah', compact('pages', 'menus'))->with('title', 'Tambah Menu');
    }
    
    public function prosesTambah(Request $request)
{
    $request->validate([
        'nama_menu' => 'required',
        'jenis_menu' => 'required|in:page,url',
        'target_menu' => 'required|in:_self,_blank',
        'status_menu' => 'required|boolean',
        'url_page' => 'nullable|integer',
        'url_manual' => 'nullable|string',
        'parent_menu' => 'nullable|integer|exists:menu,id_menu',
    ]);

    // Tentukan url_menu
    $url_menu = null;
    if ($request->jenis_menu == 'page') {
        $url_menu = $request->url_page;
    } elseif ($request->jenis_menu == 'url') {
        $url_menu = $request->url_manual;
    }

    if (!$url_menu) {
        return back()->withErrors(['url_menu' => 'URL atau Page harus dipilih.']);
    }

    // Cari urutan terakhir
    $lastOrder = \App\Models\Menu::max('urutan_menu') ?? 0;
    $newOrder = $lastOrder + 1;

    // Simpan data
    \App\Models\Menu::create([
        'nama_menu' => $request->nama_menu,
        'jenis_menu' => $request->jenis_menu,
        'url_menu' => $url_menu,
        'target_menu' => $request->target_menu,
        'parent_menu' => $request->parent_menu,
        'status_menu' => $request->status_menu,
        'urutan_menu' => $newOrder,
    ]);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
}




    public function ubah($id)
    {
        $menu = Menu::findOrFail($id);
        $pages = Page::all();
        $menus = Menu::where('id_menu', '!=', $id)->get();
        return view('menu.ubah', compact('menu', 'pages', 'menus'))->with('title', 'Ubah Menu');
    }
    public function prosesUbah(Request $request, $id_menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'jenis_menu' => 'required|in:url,page',
            'target_menu' => 'required|in:_self,_blank',
            'status_menu' => 'required|boolean',
            'url_page' => 'nullable|integer', // Sekarang harus integer
            'url_manual' => 'nullable|string',
            'parent_menu' => 'nullable|integer|exists:menu,id_menu',
        ]);

        // dd($request);

        $menu = Menu::findOrFail($id_menu);

        // Cek jenis_menu untuk menentukan URL yang diambil
        $url_menu = null;
        if ($request->jenis_menu == 'page') {
            $url_menu = $request->url_page; // ID PAGE (angka)
        } elseif ($request->jenis_menu == 'url') {
            $url_menu = $request->url_manual; // URL biasa
        }

        if (!$url_menu) {
            return back()->withErrors(['url_menu' => 'URL atau Page harus dipilih.']);
        }

        $menu->nama_menu = $request->nama_menu;
        $menu->jenis_menu = $request->jenis_menu;
        $menu->url_menu = $url_menu;
        $menu->target_menu = $request->target_menu;
        $menu->parent_menu = $request->parent_menu ?? null;
        $menu->status_menu = $request->status_menu;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate.');
    } 

    public function hapus($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->status_menu = !$menu->status_menu;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Status menu berhasil diubah.');
    }

    public function naik($id)
    {
        $menu = Menu::findOrFail($id);

        // Cari menu sebelum sekarang (yang urutannya lebih kecil)
        $previousMenu = Menu::where('parent_menu', $menu->parent_menu)
                            ->where('urutan_menu', '<', $menu->urutan_menu)
                            ->orderBy('urutan_menu', 'desc')
                            ->first();

        if ($previousMenu) {
            // Tukar urutan
            $currentOrder = $menu->urutan_menu;
            $menu->urutan_menu = $previousMenu->urutan_menu;
            $previousMenu->urutan_menu = $currentOrder;

            $menu->save();
            $previousMenu->save();
        }

        return redirect()->back();
    }

    public function turun($id)
    {
        $menu = Menu::findOrFail($id);

        // Cari menu setelah sekarang (yang urutannya lebih besar)
        $nextMenu = Menu::where('parent_menu', $menu->parent_menu)
                        ->where('urutan_menu', '>', $menu->urutan_menu)
                        ->orderBy('urutan_menu', 'asc')
                        ->first();

        if ($nextMenu) {
            // Tukar urutan
            $currentOrder = $menu->urutan_menu;
            $menu->urutan_menu = $nextMenu->urutan_menu;
            $nextMenu->urutan_menu = $currentOrder;

            $menu->save();
            $nextMenu->save();
        }

        return redirect()->back();
    }

}
