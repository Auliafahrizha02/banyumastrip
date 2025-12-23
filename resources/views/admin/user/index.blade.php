@extends('admin.layout')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900">👥 Kelola Pengguna</h1>
        <p class="text-gray-600 mt-2">Daftar semua pengguna terdaftar di sistem dan atur role mereka</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 text-green-700">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100 border-b-2 border-blue-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">No</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">Role</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-blue-900">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users ?? [] as $user)
                        <tr class="hover:bg-blue-50 transition duration-150 border-l-4 border-transparent hover:border-blue-500">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="rounded border border-gray-300 text-sm px-2 py-1 focus:ring-2 focus:ring-blue-500" onchange="this.form.submit();">
                                        <option value="user" @if($user->role === 'user') selected @endif>👤 User</option>
                                        <option value="admin" @if($user->role === 'admin') selected @endif>👨‍💼 Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
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
                            <td class="px-6 py-12 text-center" colspan="5">
                                <div class="text-5xl mb-4">👥</div>
                                <p class="text-gray-600 font-bold">Belum ada pengguna terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
