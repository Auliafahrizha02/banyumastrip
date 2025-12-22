@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Masuk ke BmsTrip</h2>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg mb-4">
            @foreach($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                placeholder="user@example.com"
            >
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                placeholder="••••••••"
            >
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition"
        >
            Masuk
        </button>
    </form>

    <!-- Demo Accounts Info -->
    <div class="mt-6 pt-6 border-t">
        <p class="text-sm text-gray-600 mb-3"><strong>Akun Demo:</strong></p>
        <ul class="text-sm text-gray-600 space-y-2">
            <li><strong>Admin:</strong> admin@bmstrip.local / password</li>
            <li><strong>User:</strong> budi@example.com / password</li>
        </ul>
    </div>

    <!-- Link to Register -->
    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
