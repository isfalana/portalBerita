@extends('admin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Ubah Page</h2>

<form action="{{ route('page.prosesUbah', $page->id_page) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="judul_page" class="block text-sm font-medium">Judul Page</label>
        <input type="text" name="judul_page" id="judul_page" value="{{ $page->judul_page }}"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
    </div>

    <div class="mb-4">
        <label for="isi_page" class="block text-sm font-medium">Isi Page</label>
        <textarea name="isi_page" id="isi_page" rows="6"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">{{ $page->isi_page }}</textarea>
    </div>

    <div class="mb-4">
        <label for="status_page" class="block text-sm font-medium">Status</label>
        <select name="status_page" id="status_page"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            <option value="1" {{ $page->status_page == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $page->status_page == 0 ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
    </div>

    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">Simpan Perubahan</button>
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
