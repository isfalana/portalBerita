@extends('admin')

@php
    $title = 'Ubah Berita';
@endphp

@section('content')
<form action="{{ route('berita.prosesUbah', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Judul --}}
    <div class="mb-4">
        <label for="judul" class="block text-sm font-medium">Judul</label>
        <input type="text" name="judul" id="judul"
               value="{{ old('judul', $berita->judul_berita) }}"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
    </div>

    {{-- Kategori --}}
    <div class="mb-4">
        <label for="id_kategori" class="block text-sm font-medium">Kategori</label>
        <select name="id_kategori" id="id_kategori"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}" {{ old('id_kategori', $berita->id_kategori) == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>


    {{-- Gambar lama --}}
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Gambar Saat Ini</label>
        @if($berita->gambar_berita)
            <img src="{{ asset('storage/' . $berita->gambar_berita) }}" class="h-32 rounded border">
        @else
            <p class="text-sm italic text-gray-500">Tidak ada gambar</p>
        @endif
    </div>

    {{-- Upload Gambar Baru --}}
    <div class="mb-4">
        <label for="gambar" class="block text-sm font-medium">Ganti Gambar (opsional)</label>
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

    {{-- Isi Berita --}}
    <div class="mb-4">
        <label for="isi" class="block text-sm font-medium">Isi Berita</label>
        <textarea name="isi" id="isi" rows="10"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">{{ old('isi', $berita->isi_berita) }}</textarea>
    </div>

    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">Perbarui</button>
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
        image.onload = () => URL.revokeObjectURL(image.src);
    }
</script>
@endsection
