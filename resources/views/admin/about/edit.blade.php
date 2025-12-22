@extends('admin.layout')

@section('title', 'Edit About Page')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">📄 Edit Halaman Tentang</h1>
        <p class="text-gray-600 mt-2">Kelola konten dan gambar untuk halaman "Tentang Banyumas"</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <h4 class="font-semibold text-red-900 mb-2">⚠️ Ada kesalahan:</h4>
            <ul class="list-disc list-inside text-red-700 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 text-green-700">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.about.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
            <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">Judul Halaman</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $about?->title ?? 'Tentang Banyumas') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                placeholder="Judul halaman tentang"
            >
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image URL -->
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
            <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">URL Gambar</label>
            <input
                type="url"
                id="image"
                name="image"
                value="{{ old('image', $about?->image ?? '') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror"
                placeholder="https://example.com/image.jpg"
            >
            <p class="text-gray-500 text-sm mt-2">💡 Gunakan URL gambar dari Unsplash atau sumber lain</p>

            @if($about?->image)
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar:</p>
                    <img src="{{ $about->image }}" alt="Preview" class="w-full max-w-md h-64 object-cover rounded-lg border border-gray-200">
                </div>
            @endif

            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
            <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi Kota</label>
            <textarea
                id="description"
                name="description"
                rows="12"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm @error('description') border-red-500 @enderror"
                placeholder="Tulis deskripsi tentang kota Banyumas di sini..."
            >{{ old('description', $about?->description ?? '') }}</textarea>
            <p class="text-gray-500 text-sm mt-2">💡 Gunakan baris baru untuk pemisahan paragraf. HTML tidak didukung.</p>

            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Buttons -->
        <div class="flex gap-4">
            <button
                type="submit"
                class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:from-blue-600 hover:to-blue-700 transition shadow-lg"
            >
                💾 Simpan Perubahan
            </button>
            <a
                href="{{ route('admin.dashboard') }}"
                class="flex-1 bg-gray-200 text-gray-900 px-6 py-3 rounded-lg font-bold hover:bg-gray-300 transition text-center"
            >
                ← Batal
            </a>
        </div>
    </form>

    <!-- Info Box -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h3 class="font-bold text-blue-900 mb-2">📌 Informasi Penting</h3>
        <ul class="text-blue-800 text-sm space-y-1 list-disc list-inside">
            <li>Data yang Anda edit akan ditampilkan di halaman publik "Tentang"</li>
            <li>Gunakan URL gambar eksternal (Unsplash, Imgur, dll)</li>
            <li>Deskripsi mendukung pemisahan baris (Enter)</li>
            <li>Preview tersedia di halaman publik setelah disimpan</li>
        </ul>
    </div>
</div>

<style>
    textarea {
        resize: vertical;
        tab-size: 4;
    }
</style>

@endsection
