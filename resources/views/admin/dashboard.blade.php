@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<!-- Simple dashboard with stats and recent reviews -->
<div class="space-y-6">
    <!-- Alerts -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Total Wisata</div>
            <div class="text-2xl font-bold">{{ $wisataCount ?? '—' }}</div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Total Kategori</div>
            <div class="text-2xl font-bold">{{ $categoryCount ?? '—' }}</div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Total Pengguna</div>
            <div class="text-2xl font-bold">{{ $userCount ?? '—' }}</div>
        </div>
    </div>

    <section id="reviews" class="mt-6">
        <h3 class="text-lg font-semibold mb-3">Ulasan Terbaru</h3>
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Wisata</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">User</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Rating</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Komentar</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Waktu</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($reviews ?? [] as $review)
                        <tr>
                            <td class="px-6 py-3 text-sm">{{ $review->wisata->title ?? '—' }}</td>
                            <td class="px-6 py-3 text-sm">{{ $review->user->name ?? '—' }}</td>
                            <td class="px-6 py-3 text-sm">{{ $review->rating }}</td>
                            <td class="px-6 py-3 text-sm">{{ Str::limit($review->comment, 80) }}</td>
                            <td class="px-6 py-3 text-sm">{{ $review->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-3 text-sm text-gray-500" colspan="5">Belum ada review.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
