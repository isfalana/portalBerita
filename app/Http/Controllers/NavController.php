<?php

namespace App\Http\Controllers;

use App\Models\Menu;


use Illuminate\Http\Request;

class NavController extends Controller
{
    //
    public function index() {
        $menus = Menu::where('status_menu', 1)->orderBy('urutan_menu')->get();
        return view('navbar', compact( 'menus'));
    }
    


}
