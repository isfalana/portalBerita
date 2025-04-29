@extends('admin')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Data Menu</h2>
    <a href="{{ route('menu.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        + Tambah Menu
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
                <th class="py-3 px-4">Nama Menu</th>
                <th class="py-3 px-4">Status Menu</th>
                <th class="py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @php $no = 1; @endphp
            @foreach ($menus->where('parent_menu', null) as $parent)
                <tr class="border-t">
                    <td class="py-2 px-4">{{ $no++ }}</td>
                    <td class="py-2 px-4 font-semibold">{{ $parent->nama_menu }}</td>
                    <td class="py-2 px-4 font-semibold">
                        {{ $parent->status_menu == 1 ? 'Aktif' : 'Nonaktif' }}
                    </td>
                    <td class="py-2 px-4">
                        <div class="flex items-center space-x-4">
                            {{-- Tombol Panah (Naik/Turun) --}}
                            <div class="flex flex-col items-center space-y-1">
                                <form action="{{ route('menu.naik', $parent->id_menu) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-black text-xs leading-none">
                                        ▲
                                    </button>
                                </form>
                                <form action="{{ route('menu.turun', $parent->id_menu) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-black text-xs leading-none">
                                        ▼
                                    </button>
                                </form>
                            </div>

                            {{-- Tombol Ubah dan Hapus --}}
                            <div class="flex space-x-2">
                                <a href="{{ route('menu.ubah', $parent->id_menu) }}"
                                class="w-15 h-6 text-xs bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">
                                    Ubah
                                </a>
                                <form action="{{ route('menu.hapus', $parent->id_menu) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-15 h-6 text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>



                </tr>

                {{-- Anak-anak dari menu ini --}}
                @foreach ($menus->where('parent_menu', $parent->id_menu) as $child)
                    <tr class="border-t">
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 pl-6 flex items-center">
                            <span class="mr-2">•</span> {{ $child->nama_menu }}
                        </td>
                        <td class="py-2 px-4 font-semibold">
                            {{ $child->status_menu == 1 ? 'Aktif' : 'Nonaktif' }}
                        </td>
                        <td class="py-2 px-4">
                            <div class="flex items-center space-x-4">
                                {{-- Tombol Panah (Naik/Turun) --}}
                                <div class="flex flex-col items-center space-y-1">
                                    <form action="{{ route('menu.naik', $child->id_menu) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-gray-500 hover:text-black text-xs leading-none">
                                            ▲
                                        </button>
                                    </form>
                                    <form action="{{ route('menu.turun', $child->id_menu) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-gray-500 hover:text-black text-xs leading-none">
                                            ▼
                                        </button>
                                    </form>
                                </div>

                                {{-- Tombol Ubah dan Hapus --}}
                                <div class="flex space-x-2">
                                        <a href="{{ route('menu.ubah', $child->id_menu) }}"
                                        class="w-15 h-6 text-xs bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">
                                            Ubah
                                        </a>
                                    
                                    <form action="{{ route('menu.hapus', $child->id_menu) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-15 h-6 text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@endsection
