@extends('admin.layout')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">➕ Tambah Kategori Baru</h1>
        <p class="text-gray-600 mt-2">Buat kategori wisata baru untuk mengelompokkan destinasi</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-8">
            @csrf

            <!-- Nama Kategori -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-gray-900 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Contoh: Pantai, Pegunungan, Budaya"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div class="mb-6">
                <label for="slug" class="block text-sm font-bold text-gray-900 mb-2">Slug (URL)</label>
                <input type="text" name="slug" id="slug" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                    placeholder="contoh-slug"
                    value="{{ old('slug') }}">
                @error('slug')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-bold text-gray-900 mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="5"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                    placeholder="Deskripsi singkat tentang kategori wisata ini...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                <p class="text-sm text-blue-800"><strong>💡 Tips:</strong> Slug harus menggunakan huruf kecil dan tanda hubung (-) tanpa spasi. Contoh: pantai-eksotis</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-lg font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
                    ✅ Simpan Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 text-gray-900 px-8 py-3 rounded-lg font-bold hover:bg-gray-400 transition">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
