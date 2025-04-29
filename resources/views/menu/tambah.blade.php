@extends('admin')

@section('content')

<h2 class="text-2xl font-semibold mb-4">Tambah Menu</h2>

<form action="{{ route('menu.prosesTambah') }}" method="POST" x-data="{ jenisMenu: 'url' }">
    @csrf

    {{-- Nama Menu --}}
    <div class="mb-4">
        <label for="nama_menu" class="block text-sm font-medium">Nama Menu</label>
        <input type="text" name="nama_menu" id="nama_menu" 
               class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
    </div>

    {{-- Jenis Menu --}}
    <div class="mb-4">
        <label for="jenis_menu" class="block text-sm font-medium">Jenis Menu</label>
        <select name="jenis_menu" id="jenis_menu" x-model="jenisMenu"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            <option value="page">Page</option>
            <option value="url">URL</option>
        </select>
    </div>

    {{-- Jika Page --}}
    <div class="mb-4" x-show="jenisMenu === 'page'">
        <label for="url_page" class="block text-sm font-medium">Pilih Page</label>
        <select name="url_page" id="url_page"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            @foreach ($pages as $page)
                <option value="{{ $page->id_page }}">{{ $page->judul_page }}</option>
            @endforeach
        </select>
    </div>

    {{-- Jika URL --}}
    <div class="mb-4" x-show="jenisMenu === 'url'">
        <label for="url_manual" class="block text-sm font-medium">Masukkan URL</label>
        <input type="text" name="url_manual" id="url_manual"
               class="mt-1 block w-full border border-gray-300 rounded-md p-2">
    </div>

    {{-- Target Menu --}}
    <div class="mb-4">
        <label for="target_menu" class="block text-sm font-medium">Target Menu</label>
        <select name="target_menu" id="target_menu"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            <option value="_self">Tab Saat Ini</option>
            <option value="_blank">Tab Baru</option>
        </select>
    </div>

    {{-- Parent Menu --}}
    <div class="mb-4">
        <label for="parent_menu" class="block text-sm font-medium">Parent Menu</label>
        <select name="parent_menu" id="parent_menu"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            <option value="">-- Tidak Ada --</option>
            @foreach ($menus->where('parent_menu', null)->where('status_menu', 1) as $parent)
                <option value="{{ $parent->id_menu }}">{{ $parent->nama_menu }}</option>
            @endforeach
        </select>
    </div>

    {{-- Status Menu --}}
    <div class="mb-4">
        <label for="status_menu" class="block text-sm font-medium">Status Menu</label>
        <select name="status_menu" id="status_menu"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>

@endsection
