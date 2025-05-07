<x-layout>
    @section('content')

    <!-- Pencarian & Filter -->
    <div class="mb-8">
        <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

            <select name="kategori" class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
        </form>
    </div>


    <div class="max-w-7xl mx-auto py-8 px-4">

    @php
        $carouselItems = $beritas->take(3)->merge($mostViewed->take(3))->unique('id_berita');
    @endphp

    <div class="swiper beritaSwiper mb-10">
        <div class="swiper-wrapper">
            @foreach ($carouselItems as $berita)
                <div class="swiper-slide">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if ($berita->gambar_berita)
                            <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="Gambar" class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="p-4">
                            <h2 class="text-xl font-bold mb-2">{{ $berita->judul_berita }}</h2>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ Str::limit(strip_tags($berita->isi_berita), 100) }}
                            </p>
                            <a href="{{ route('berita.show', $berita->id_berita) }}" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigasi -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>


    <!-- berita terbaru card -->
    <h1 class="text-2xl font-bold mb-6">Berita Terbaru</h1>
    @if ($beritas->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($beritas as $berita)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($berita->gambar_berita)
                        <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="Gambar" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            Tidak ada gambar
                        </div>
                    @endif
                    <div class="p-4">
                        <h2 class="text-lg font-bold mb-2">{{ $berita->judul_berita }}</h2>
                        <p class="text-sm text-gray-600 mb-4">
                            {{ Str::limit(strip_tags($berita->isi_berita), 100) }}
                        </p>
                        <a href="{{ route('berita.show', $berita->id_berita) }}" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya →</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8 flex justify-center">
            {{ $beritas->links() }}
        </div>
    @else
        <p class="text-gray-500">Belum ada berita.</p>
    @endif




        <!-- Berita Paling Banyak Dilihat -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Berita Paling Banyak Dilihat</h2>

            @if ($mostViewed->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($mostViewed as $berita)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if ($berita->gambar_berita)
                                <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="Gambar" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                    Tidak ada gambar
                                </div>
                            @endif

                            <div class="p-4">
                                <h2 class="text-lg font-bold mb-2">{{ $berita->judul_berita }}</h2>
                                <p class="text-sm text-gray-600 mb-4">
                                    {{ Str::limit(strip_tags($berita->isi_berita), 100) }}
                                </p>

                                <a href="{{ route('berita.show', $berita->id_berita) }}" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya →</a>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada berita yang dilihat.</p>
            @endif
        </div>

    </div>

    @endsection
</x-layout>
