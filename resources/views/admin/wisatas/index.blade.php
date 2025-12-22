@extends('admin.layout')

@section('title', 'Kelola Wisata')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">🗺️ Kelola Wisata</h1>
            <p class="text-gray-600 mt-2">Daftar semua destinasi wisata di sistem</p>
        </div>
        <a href="{{ route('admin.wisatas.create') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg font-bold hover:from-green-600 hover:to-green-700 transition shadow-lg">
            ➕ Tambah Wisata Baru
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 text-green-700">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Wisata Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Judul</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Lokasi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($wisatas as $wisata)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ ($wisatas->currentPage() - 1) * $wisatas->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="font-semibold text-gray-900">{{ $wisata->title }}</div>
                                <div class="text-xs text-gray-500">{{ $wisata->slug }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $wisata->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $wisata->location ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-blue-600">
                                Rp {{ number_format($wisata->price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($wisata->published)
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                        ✅ Aktif
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">
                                        ⊘ Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-2">
                                    <a href="{{ route('wisatas.show', $wisata->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-700 font-medium" title="Lihat di website">
                                        👁️ Lihat
                                    </a>
                                    <a href="{{ route('admin.wisatas.index') }}" class="text-yellow-600 hover:text-yellow-700 font-medium" title="Edit">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.wisatas.destroy', $wisata) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus wisata ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-medium" title="Hapus">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-5xl mb-4">📭</div>
                                <p class="text-gray-600 font-semibold">Belum ada wisata. Silakan tambah wisata baru.</p>
                                <a href="{{ route('admin.wisatas.create') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                                    ➕ Tambah Wisata Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($wisatas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $wisatas->links() }}
            </div>
        @endif
    </div>

    <!-- Info Box -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h3 class="font-bold text-blue-900 mb-3">💡 Tips Mengelola Wisata</h3>
        <ul class="text-blue-800 text-sm space-y-2 list-disc list-inside">
            <li>Klik "<strong>Tambah Wisata Baru</strong>" untuk menambahkan destinasi baru</li>
            <li>Klik "<strong>Edit</strong>" untuk mengubah informasi wisata</li>
            <li>Klik "<strong>Lihat</strong>" untuk melihat preview di website</li>
            <li>Hanya wisata dengan status "<strong>Aktif</strong>" yang akan ditampilkan di website</li>
            <li>Slug harus unik dan tidak boleh sama dengan wisata lain</li>
        </ul>
    </div>
</div>

@endsection
