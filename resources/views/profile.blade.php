@extends('admin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Your Profile</h2>

<div class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Username</label>
        <p class="mt-1 text-gray-900 font-semibold">{{ $user->name }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <p class="mt-1 text-gray-900 font-semibold">{{ $user->email }}</p>
    </div>

    <a href="{{ route('admin.resetPassword') }}"
   class="inline-block mt-4 px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-600 transition">
    Ganti Password
</a>

</div>
@endsection
