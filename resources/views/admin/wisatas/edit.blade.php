@extends('admin.layout')

@section('title', 'Edit Wisata')

@section('content')
<div class="max-w-3xl">
    <h3 class="text-lg font-semibold mb-4">Edit Wisata</h3>

    <form action="{{ route('admin.wisatas.update', $wisata) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $wisata->title) }}" class="mt-1 block w-full rounded border-gray-200" required>
                @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $wisata->slug) }}" class="mt-1 block w-full rounded border-gray-200" required>
                @error('slug')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" class="mt-1 block w-full rounded border-gray-200" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories ?? [] as $cat)
                    <option value="{{ $cat->id }}" @if($cat->id == old('category_id', $wisata->category_id)) selected @endif>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="6" class="mt-1 block w-full rounded border-gray-200">{{ old('description', $wisata->description) }}</textarea>
            @error('description')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $wisata->location) }}" class="mt-1 block w-full rounded border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $wisata->price) }}" class="mt-1 block w-full rounded border-gray-200" min="0" step="0.01">
            </div>
        </div>

        <div class="mt-4 flex items-center gap-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="published" value="1" @if(old('published', $wisata->published)) checked @endif class="form-checkbox">
                <span class="ml-2 text-sm">Published</span>
            </label>

            <button type="submit" class="ml-auto bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
