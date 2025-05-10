@extends('admin')

@section('content')

<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-2">
    <h2 class="text-xl font-semibold">Daftar Berita</h2>
    <a href="{{ route('berita.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 w-full md:w-auto text-center">
        + Tambah Berita
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto rounded">
    <table class="min-w-full bg-white rounded shadow-md text-sm">
        <thead class="bg-gray-200 text-gray-600 text-left">
            <tr>
                <th class="py-3 px-4 whitespace-nowrap">No</th>
                <th class="py-3 px-4 whitespace-nowrap">Gambar</th>
                <th class="py-3 px-4 whitespace-nowrap">Judul</th>
                <th class="py-3 px-4 whitespace-nowrap">Kategori</th>
                <th class="py-3 px-4 whitespace-nowrap">Total Views</th> <!-- Tambahan -->
                <th class="py-3 px-4 whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse ($berita as $index => $item)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="py-2 px-4">{{ $index + 1 }}</td>
                    <td class="py-2 px-4">
                        @if($item->gambar_berita)
                            <img src="{{ asset('storage/' . $item->gambar_berita) }}" alt="Gambar Berita" class="h-16 w-20 object-cover rounded">
                        @else
                            <span class="text-gray-400 text-sm italic">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $item->judul_berita }}</td>
                    <td class="py-2 px-4">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="py-2 px-4">{{ $item->total_views ?? 0 }}</td> <!-- Tambahan -->
                    <td class="py-2 px-4 space-y-1 md:space-y-0 md:space-x-2">
                        <a href="{{ route('berita.ubah', $item->id_berita) }}"
                           class="inline-block bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                            Edit
                        </a>
                        <form action="{{ route('berita.hapus', $item->id_berita) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-3 px-4 text-center text-gray-500">Belum ada berita</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
