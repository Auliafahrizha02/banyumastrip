@extends('admin.layout')

@section('title', 'Kelola Pengguna')

@section('content')
<!-- Users list for admin -->
<div class="space-y-4">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Role</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($users ?? [] as $user)
                    <tr>
                        <td class="px-6 py-3 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->role }}</td>
                        <td class="px-6 py-3 text-sm">
                            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <select name="role" class="rounded border-gray-200 text-sm" onchange="this.form.submit();">
                                    <option value="user" @if($user->role === 'user') selected @endif>User</option>
                                    <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                                </select>
                            </form>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Hapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500" colspan="5">Belum ada pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>
        {{ $users->links() ?? '' }}
    </div>
</div>
@endsection
