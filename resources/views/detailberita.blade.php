<x-layout>
    @section('content')

    <div class="max-w-7xl mx-auto py-8 px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Konten Utama (2/3) --}}
        <div class="lg:col-span-2">
            <h1 class="text-3xl font-bold mb-4">{{ $berita->judul_berita }}</h1>

            @if ($berita->gambar_berita)
                <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="Gambar Berita"
                     class="w-full h-64 object-cover rounded mb-6">
            @endif

            <div class="text-gray-700 leading-relaxed">
                {!! $berita->isi_berita !!}
            </div>

            <a href="{{ route('home') }}" class="mt-6 inline-block text-blue-600 hover:underline">← Kembali</a>
        </div>

        {{-- Sidebar Rekomendasi (1/3) --}}
        <div class="space-y-4">
            <h2 class="text-xl font-bold mb-4">Berita Lainnya</h2>

            @forelse ($rekomendasi as $item)
                <div class="bg-white rounded shadow overflow-hidden">
                    @if ($item->gambar_berita)
                        <img src="{{ asset('storage/' . $item->gambar_berita) }}" alt="Gambar"
                             class="w-full h-24 object-cover">
                    @endif
                    <div class="p-3">
                        <h3 class="text-sm font-semibold leading-snug">
                            <a href="{{ route('berita.show', $item->id_berita) }}"
                               class="text-gray-800 hover:text-blue-600 hover:underline">
                                {{ Str::limit($item->judul_berita, 60) }}
                            </a>
                        </h3>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada rekomendasi berita lain.</p>
            @endforelse
        </div>

    </div>

    @endsection
</x-layout>
