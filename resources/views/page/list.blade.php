@extends('admin')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Daftar Page</h2>
    <a href="{{ route('page.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        + Tambah Page
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
                <th class="py-3 px-4">Judul</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse ($page as $index => $item)
                <tr class="border-t">
                    <td class="py-2 px-4">{{ $index + 1 }}</td>

                    {{-- Judul berita --}}
                    <td class="py-2 px-4">{{ $item->judul_page }}</td>

                    {{-- Nama kategori --}}
                    <td class="py-2 px-4">{{($item->status_page == 1 ? "Aktif" : "Tidak Aktif")}}</td>

                    
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('page.ubah', $item->id_page) }}"
                           class="text-sm bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                            Edit
                        </a>
                        <form action="{{ route('page.hapus', $item->id_page) }}" method="POST" class="inline-block"
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
                    <td colspan="5" class="py-3 px-4 text-center text-gray-500">Belum ada Page</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
