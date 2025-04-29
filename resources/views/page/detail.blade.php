<x-layout>
    @section('content')

    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-4">{{ $page->judul }}</h1>

        @if ($page->gambar)
            <img src="{{ asset('storage/' . $page->gambar) }}" alt="Gambar Halaman" class="w-full h-64 object-cover rounded mb-6">
        @endif

        <div class="text-gray-700 leading-relaxed">
            {!! $page->isi !!}
        </div>

        <a href="{{ route('home') }}" class="mt-6 inline-block text-blue-600 hover:underline">← Kembali ke Beranda</a>
    </div>

    @endsection
</x-layout>
