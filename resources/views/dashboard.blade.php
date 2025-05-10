@extends('admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <!-- Total Berita -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-gray-500 text-sm">Total Berita</h3>
        <p class="text-2xl font-bold text-blue-600 mt-1">{{ $totalBerita }}</p>
    </div>

    <!-- Total Kategori -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-gray-500 text-sm">Total Kategori</h3>
        <p class="text-2xl font-bold text-green-600 mt-1">{{ $totalKategori }}</p>
    </div>

    <!-- Waktu Sekarang -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-gray-500 text-sm">Tanggal Sekarang</h3>
        <p class="text-2xl font-bold text-gray-700 mt-1">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </p>
    </div>
</div>

<!-- Latest News -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold mb-4">Berita Terbaru</h3>

    @if ($latestNews->isEmpty())
        <p class="text-gray-500 italic">Belum ada berita terbaru.</p>
    @else
        <ul class="divide-y divide-gray-200 space-y-4">
            @foreach ($latestNews as $news)
                <li class="pt-2 first:pt-0">
                    {{-- Gambar --}}
                    @if ($news->gambar_berita)
                            <img src="{{ asset('storage/' . $news->gambar_berita) }}"
                                 alt="Gambar Berita"
                                 class="h-32 w-32 object-cover rounded">
                        @else
                            <div class="h-32 w-32 bg-gray-200 flex items-center justify-center text-gray-500 text-sm italic rounded">
                                Tidak ada gambar
                            </div>
                        @endif
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        

                        {{-- Info --}}
                        <div class="flex-1">
                            <div class="flex justify-between items-start sm:items-center gap-2 flex-col sm:flex-row">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $news->judul_berita }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}
                                        — {{ $news->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </p>
                                </div>
                                <a href="{{ route('berita.ubah', $news->id_berita) }}"
                                   class="text-blue-600 text-sm font-medium hover:underline whitespace-nowrap">
                                    Edit Berita →
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
