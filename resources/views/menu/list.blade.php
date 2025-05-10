@extends('admin')

@section('content')

<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-2">
    <h2 class="text-xl font-semibold">Data Menu</h2>
    <a href="{{ route('menu.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 w-full md:w-auto text-center">
        + Tambah Menu
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="w-full overflow-x-auto rounded">
    <table class="min-w-[640px] bg-white rounded shadow-md text-sm">
        <thead class="bg-gray-200 text-gray-600 text-left">
            <tr>
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Nama Menu</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @php $no = 1; @endphp
            @foreach ($menus->where('parent_menu', null) as $parent)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="py-2 px-4">{{ $no++ }}</td>
                    <td class="py-2 px-4 font-semibold">{{ $parent->nama_menu }}</td>
                    <td class="py-2 px-4">
                        <span class="px-2 py-1 rounded text-sm {{ $parent->status_menu == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ $parent->status_menu == 1 ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="py-2 px-4">
                        <div class="flex items-center gap-1 flex-wrap">
                            <form action="{{ route('menu.naik', $parent->id_menu) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-black text-xs h-7 w-7 flex items-center justify-center">▲</button>
                            </form>
                            <form action="{{ route('menu.turun', $parent->id_menu) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-black text-xs h-7 w-7 flex items-center justify-center">▼</button>
                            </form>
                            <a href="{{ route('menu.ubah', $parent->id_menu) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-xs h-7 flex items-center justify-center">
                                Ubah
                            </a>
                            <form action="{{ route('menu.hapus', $parent->id_menu) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs h-7 flex items-center justify-center mt-4">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- Submenu --}}
                @foreach ($menus->where('parent_menu', $parent->id_menu) as $child)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 pl-6 flex items-center"><span class="mr-2">•</span> {{ $child->nama_menu }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 rounded text-sm {{ $child->status_menu == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ $child->status_menu == 1 ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="py-2 px-4">
                            <div class="flex items-center gap-1 flex-wrap">
                                <form action="{{ route('menu.naik', $child->id_menu) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-black text-xs h-7 w-7 flex items-center justify-center">▲</button>
                                </form>
                                <form action="{{ route('menu.turun', $child->id_menu) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-black text-xs h-7 w-7 flex items-center justify-center">▼</button>
                                </form>
                                <a href="{{ route('menu.ubah', $child->id_menu) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-xs h-7 flex items-center justify-center">
                                    Ubah
                                </a>
                                <form action="{{ route('menu.hapus', $child->id_menu) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs h-7 flex items-center justify-center mt-4">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@endsection
