@extends('admin.layout')

@section('title', 'Kelola Kategori')

@section('content')
<!-- Kategori index: list categories -->
<div class="space-y-4">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center">
        <h3 class="text-lg font-semibold">Daftar Kategori</h3>
        <a href="{{ route('admin.categories.index') }}?create=1" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah Kategori</a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Slug</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($categories ?? [] as $cat)
                    <tr>
                        <td class="px-6 py-3 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-sm">{{ $cat->name }}</td>
                        <td class="px-6 py-3 text-sm">{{ $cat->slug }}</td>
                        <td class="px-6 py-3 text-sm">
                            <a href="{{ route('admin.categories.index') }}?edit={{ $cat->id }}" class="text-blue-600 mr-2">Edit</a>

                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500" colspan="4">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
