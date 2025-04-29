@extends('admin')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="text-xl font-semibold mb-4">Ubah Kategori</h2>

    <form action="{{ route('kategori.prosesUbah', $kategori->id_kategori) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Update</button>
    </form>
@endsection
