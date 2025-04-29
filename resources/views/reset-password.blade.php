@extends('admin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Reset Password</h2>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.resetPassword.proses') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label for="password_lama" class="block text-sm font-medium">Password Lama</label>
        <input type="password" name="password_lama" id="password_lama" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
        <label for="password_baru" class="block text-sm font-medium">Password Baru</label>
        <input type="password" name="password_baru" id="password_baru" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
        <label for="password_baru_confirmation" class="block text-sm font-medium">Konfirmasi Password Baru</label>
        <input type="password" name="password_baru_confirmation" id="password_baru_confirmation" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Reset Password</button>
</form>
@endsection
