@extends('admin.layout')

@section('title', 'Buat Kategori')

@section('content')
<div class="max-w-2xl">
    <h3 class="text-lg font-semibold mb-4">Buat Kategori Baru</h3>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full rounded border-gray-200" required>
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="mt-1 block w-full rounded border-gray-200" required>
            @error('slug')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4" class="mt-1 block w-full rounded border-gray-200">{{ old('description') }}</textarea>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
