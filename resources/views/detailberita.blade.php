<x-layout>
    @section('content')

    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-4">{{ $berita->judul_berita }}</h1>

        @if ($berita->gambar_berita)
            <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="Gambar Berita" class="w-full h-64 object-cover rounded mb-6">
        @endif

        <div class="text-gray-700 leading-relaxed">
            {!! $berita->isi_berita !!}
        </div>

        <a href="{{ url()->previous() }}" class="mt-6 inline-block text-blue-600 hover:underline">← Kembali</a>
    </div>

    @endsection
</x-layout>
