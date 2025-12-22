@extends('admin.layout')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl">
    <h3 class="text-lg font-semibold mb-4">Edit Kategori</h3>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full rounded border-gray-200" required>
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="mt-1 block w-full rounded border-gray-200" required>
            @error('slug')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4" class="mt-1 block w-full rounded border-gray-200">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
