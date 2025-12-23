@extends('admin.layout')

@section('title', 'Tambah Wisata Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">🗺️ Tambah Wisata Baru</h1>
        <p class="text-gray-600 mt-2">Tambahkan informasi lengkap destinasi wisata baru ke BmsTrip</p>
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

    <form action="{{ route('admin.wisatas.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Kategori & Status -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
            <h3 class="text-lg font-bold text-blue-900 mb-4">📋 Informasi Dasar</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-900 mb-2">
                        🏷️ Kategori <span class="text-red-600">*</span>
                    </label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror"
                        required
                    >
                        <option value="">-- Pilih Kategori --</option>
                        @forelse($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @empty
                            <option disabled>Tidak ada kategori</option>
                        @endforelse
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published Status -->
                <div>
                    <label for="published" class="block text-sm font-semibold text-gray-900 mb-2">
                        📢 Status Publikasi
                    </label>
                    <div class="flex items-center gap-4 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="published" value="1" {{ old('published', true) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded">
                            <span class="text-gray-700">Publikasikan sekarang</span>
                        </label>
                    </div>
                    <p class="text-gray-500 text-xs mt-2">Jika dicentang, wisata akan terlihat di website</p>
                </div>
            </div>
        </div>

        <!-- Judul & Slug -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
            <h3 class="text-lg font-bold text-blue-900 mb-4">📝 Judul & URL</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                        Judul Wisata <span class="text-red-600">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="Contoh: Curug Cipendok"
                        required
                    >
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-semibold text-gray-900 mb-2">
                        Slug (URL) <span class="text-red-600">*</span>
                    </label>
                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        value="{{ old('slug') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('slug') border-red-500 @enderror"
                        placeholder="Contoh: curug-cipendok"
                        required
                    >
                    <p class="text-gray-500 text-xs mt-1">💡 Gunakan huruf kecil dan hubung dengan dash (-)</p>
                    @error('slug')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Lokasi & Harga -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
            <h3 class="text-lg font-bold text-blue-900 mb-4">📍 Lokasi & Harga</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Lokasi -->
                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-900 mb-2">
                        Lokasi
                    </label>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location') border-red-500 @enderror"
                        placeholder="Contoh: Desa Sidareja, Banyumas"
                    >
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-900 mb-2">
                        Harga (Rp)
                    </label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        min="0"
                        step="1000"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                        placeholder="Contoh: 30000"
                    >
                    <p class="text-gray-500 text-xs mt-1">💡 Kosongkan jika gratis atau harga bervariasi</p>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
            <h3 class="text-lg font-bold text-blue-900 mb-4">📖 Deskripsi Lengkap</h3>
            
            <textarea
                id="description"
                name="description"
                rows="8"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm @error('description') border-red-500 @enderror"
                placeholder="Tulis deskripsi lengkap tentang wisata ini. Contoh fasilitas, aktivitas, jam operasional, dll."
            >{{ old('description') }}</textarea>
            <p class="text-gray-500 text-xs mt-2">💡 Gunakan baris baru untuk pemisahan paragraf</p>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gambar -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
            <h3 class="text-lg font-bold text-blue-900 mb-4">🖼️ Gambar</h3>
            
            <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">
                URL Gambar
            </label>
            <input
                type="url"
                id="image"
                name="image"
                value="{{ old('image') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror"
                placeholder="https://images.unsplash.com/photo-..."
            >
            <p class="text-gray-500 text-xs mt-2">💡 Gunakan URL gambar dari Unsplash, Pexels, atau sumber lain</p>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6 shadow-sm">
            <h4 class="font-bold text-blue-900 mb-3">📌 Tips Mengisi Form</h4>
            <ul class="text-blue-800 text-sm space-y-2 list-disc list-inside">
                <li><strong>Kategori:</strong> Pilih yang paling sesuai dengan jenis wisata</li>
                <li><strong>Slug:</strong> Harus unik (tidak boleh sama dengan wisata lain)</li>
                <li><strong>Deskripsi:</strong> Jelaskan detail wisata, fasilitas, aktivitas, dll</li>
                <li><strong>Gambar:</strong> Gunakan URL eksternal (Unsplash, Pexels, Imgur, dll)</li>
                <li><strong>Status:</strong> Centang untuk langsung tampil di website</li>
            </ul>
        </div>

        <!-- Submit Buttons -->
        <div class="flex gap-4 pb-6">
            <button
                type="submit"
                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg hover:shadow-xl"
            >
                ✅ Tambah Wisata
            </button>
            <a
                href="{{ route('admin.wisatas.index') }}"
                class="flex-1 bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-bold hover:bg-gray-400 transition text-center shadow-md"
            >
                ← Batal
            </a>
        </div>
    </form>
</div>

<style>
    textarea {
        resize: vertical;
        tab-size: 4;
    }
</style>

@endsection
