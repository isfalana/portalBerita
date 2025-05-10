@extends('admin')



@section('content')

<script>
function menuForm() {
    return {
        jenisMenu: '',
        urlManual: '',
        initialUrl: '',
        init(jenisMenu, initialUrl) {
            this.jenisMenu = jenisMenu;
            this.initialUrl = initialUrl;
            this.urlManual = jenisMenu === 'url' ? initialUrl : '';
            this.$watch('jenisMenu', value => {
                if (value === 'url') {
                    this.urlManual = this.initialUrl;
                } else {
                    this.urlManual = '';
                }
            });

        }
    }
}
</script>



<h2 class="text-2xl font-semibold mb-4">Ubah Menu</h2>



{{-- Form untuk ubah menu --}}

<form 
    action="{{ route('menu.prosesUbah', $menu->id_menu) }}" 
    method="POST"
    x-data="menuForm()"
    x-init="init('{{ $menu->jenis_menu }}', '{{ $menu->url_menu }}')"
>   

    @csrf

    @method('PUT')



    {{-- Nama Menu --}}

    <div class="mb-4">

        <label for="nama_menu" class="block text-sm font-medium">Nama Menu</label>

        <input type="text" name="nama_menu" id="nama_menu" value="{{ $menu->nama_menu }}"

               class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>

    </div>



    {{-- Jenis Menu --}}

    <div class="mb-4">

        <label for="jenis_menu" class="block text-sm font-medium">Jenis Menu</label>

        <select name="jenis_menu" id="jenis_menu" x-model="jenisMenu"

                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>

            <option value="page" {{ $menu->jenis_menu == 'page' ? 'selected' : '' }}>Page</option>

            <option value="url" {{ $menu->jenis_menu == 'url' ? 'selected' : '' }}>URL</option>

        </select>

    </div>



    {{-- Pilih Page --}}

    <div class="mb-4" x-show="jenisMenu === 'page'">

        <label for="url_page" class="block text-sm font-medium">Pilih Page</label>

        <select name="url_page" id="url_page"

            class="mt-1 block w-full border border-gray-300 rounded-md p-2">

            @foreach ($pages as $page)

                <option value="{{ $page->id_page }}"

                    {{ (int) $menu->url_menu === (int) $page->id_page ? 'selected' : '' }}>

                    {{ $page->judul_page }}

                </option>

            @endforeach

        </select>

    </div>





    {{-- Jika URL Dipilih --}}

    <div class="mb-4" x-show="jenisMenu === 'url'">

        <label for="url_manual" class="block text-sm font-medium">Masukkan URL</label>

        <input type="text" name="url_manual" id="url_manual"

            x-model="urlManual"

            class="mt-1 block w-full border border-gray-300 rounded-md p-2"

            placeholder="Masukkan URL...">

    </div>





    {{-- Target Menu --}}

    <div class="mb-4">

        <label for="target_menu" class="block text-sm font-medium">Target Menu</label>

        <select name="target_menu" id="target_menu"

                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>

            <option value="_self" {{ $menu->target_menu == '_self' ? 'selected' : '' }}>Tab Saat Ini</option>

            <option value="_blank" {{ $menu->target_menu == '_blank' ? 'selected' : '' }}>Tab Baru</option>

        </select>

    </div>



    {{-- Parent Menu --}}

    <div class="mb-4">

        <label for="parent_menu" class="block text-sm font-medium">Parent Menu</label>

        <select name="parent_menu" id="parent_menu" 

                class="mt-1 block w-full border border-gray-300 rounded-md p-2">

            <option value="">-- Tidak ada --</option>

            @foreach ($menus->where('parent_menu', null)->where('status_menu', 1) as $parent)

                <option value="{{ $parent->id_menu }}"

                    {{ (isset($menu) && $menu->parent_menu == $parent->id_menu) ? 'selected' : '' }}>

                    {{ $parent->nama_menu }}

                </option>

            @endforeach

        </select>

    </div>



    {{-- Status Menu --}}

    <div class="mb-4">

        <label for="status_menu" class="block text-sm font-medium">Status Menu</label>

        <select name="status_menu" id="status_menu"

                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>

            <option value="1" {{ $menu->status_menu == 1 ? 'selected' : '' }}>Aktif</option>

            <option value="0" {{ $menu->status_menu == 0 ? 'selected' : '' }}>Nonaktif</option>

        </select>

    </div>



    {{-- Tombol Submit --}}

    <button type="submit" class="px-4 py-2 bg-yellow-400 hover:bg-yellow-600 text-white rounded">
        Simpan Perubahan
    </button>

    <a href="{{ route('menu.index')}}"
            class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-400">
            Kembali
    </a>

</form>



@endsection