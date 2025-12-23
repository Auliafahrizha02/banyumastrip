@extends('admin.layout')

@section('title', 'Kelola Kategori')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">📂 Kelola Kategori</h1>
            <p class="text-gray-600 mt-2">Daftar semua kategori wisata di sistem</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
            ➕ Tambah Kategori
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 text-green-700">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Kategori Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100 border-b-2 border-blue-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">No</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">Nama Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">Slug</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories ?? [] as $cat)
                        <tr class="hover:bg-blue-50 transition duration-150 border-l-4 border-transparent hover:border-blue-500">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $cat->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $cat->slug }}</td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="text-amber-600 hover:text-amber-800 font-bold text-xs bg-amber-100 px-3 py-1 rounded transition inline-block">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs bg-red-100 px-3 py-1 rounded transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="text-5xl mb-4">📭</div>
                                <p class="text-gray-600 font-bold">Belum ada kategori. Silakan tambah kategori baru.</p>
                                <a href="{{ route('admin.categories.create') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-bold">
                                    ➕ Tambah Kategori Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
</div>
@endsection
