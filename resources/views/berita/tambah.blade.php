@extends('admin')

@php
    $title = 'Tambah Berita';
@endphp

@section('content')
@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('berita.prosesTambah') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Judul --}}
    <div class="mb-4">
        <label for="judul" class="block text-sm font-medium">Judul</label>
        <input type="text" name="judul" id="judul"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
    </div>

    {{-- Kategori --}}
    <div class="mb-4">
        <label for="id_kategori" class="block text-sm font-medium">Kategori</label>
        <select name="id_kategori"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm " required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    {{-- Gambar dengan preview --}}
    <div class="mb-4">
        <label for="gambar" class="block text-sm font-medium">Gambar Berita</label>
        <input type="file" name="gambar" id="gambar"
               class="mt-1 block w-full text-sm" accept="image/*" onchange="previewImage(event)">
        <div class="mt-2">
            <img id="preview"
                 src="#"
                 onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/1829/1829586.png'"
                 class="h-32 w-32 object-cover rounded border mt-2"
                 alt="Preview Gambar">
        </div>
    </div>

    {{-- Isi Berita (CKEditor) --}}
    <div class="mb-4">
        <label for="isi" class="block text-sm font-medium">Isi Berita</label>
        <textarea name="isi" id="isi" rows="10"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#isi'))
        .catch(error => {
            console.error(error);
        });

    function previewImage(event) {
        const image = document.getElementById('preview');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.onload = () => URL.revokeObjectURL(image.src); // Free memory
    }
</script>
@endsection
