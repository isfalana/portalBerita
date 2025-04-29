@extends('admin')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Daftar Berita</h2>
    <a href="{{ route('berita.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        + Tambah Berita
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow-md">
        <thead class="bg-gray-200 text-gray-600 text-left">
            <tr>
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Gambar</th>
                <th class="py-3 px-4">Judul</th>
                <th class="py-3 px-4">Kategori</th>
                <th class="py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse ($berita as $index => $item)
                <tr class="border-t">
                    <td class="py-2 px-4">{{ $index + 1 }}</td>

                    {{-- Gambar berita --}}
                    <td class="py-2 px-4">
                        @if($item->gambar_berita)
                            <img src="{{ asset('storage/' . $item->gambar_berita) }}" alt="Gambar Berita" class="h-16 rounded">
                        @else
                            <span class="text-gray-400 text-sm italic">Tidak ada gambar</span>
                        @endif
                    </td>

                    {{-- Judul berita --}}
                    <td class="py-2 px-4">{{ $item->judul_berita }}</td>

                    {{-- Nama kategori --}}
                    <td class="py-2 px-4">{{ $item->kategori->nama_kategori ?? '-' }}</td>

                    
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('berita.ubah', $item->id_berita) }}"
                           class="text-sm bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                            Edit
                        </a>
                        <form action="{{ route('berita.hapus', $item->id_berita) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-3 px-4 text-center text-gray-500">Belum ada berita</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
