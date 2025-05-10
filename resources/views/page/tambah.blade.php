@extends('admin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Tambah Page</h2>

<form action="{{ route('page.prosesTambah') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="judul_page" class="block text-sm font-medium">Judul Page</label>
        <input type="text" name="judul_page" id="judul_page"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
    </div>

    <div class="mb-4">
        <label for="isi_page" class="block text-sm font-medium">Isi Page</label>
        <textarea name="isi_page" id="isi_page" rows="6"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
    </div>

    <div class="mb-4">
        <label for="status_page" class="block text-sm font-medium">Status</label>
        <select name="status_page" id="status_page" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-400">Simpan</button>
    <a href="{{ route('page.index')}}"
        class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-400">
            Kembali
    </a>
</form>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#isi_page'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
