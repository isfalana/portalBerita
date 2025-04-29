<x-layout>
    @section('content')

    <div class="max-w-7xl mx-auto py-8 px-4">

        <!-- Berita Terbaru -->
        <h1 class="text-3xl font-bold mb-6">Berita Terbaru</h1>

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

            <div class="mt-8">
                {{ $beritas->links() }} <!-- Pagination -->
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
