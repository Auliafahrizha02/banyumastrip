@extends('layouts.app')

@section('title', 'Daftar Wisata')

@section('content')
<!-- =============== PAGE HEADER =============== -->
<div class="mb-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-2">Semua Destinasi Wisata</h1>
    <p class="text-gray-600">Jelajahi berbagai pilihan wisata menarik di Banyumas</p>
</div>

<!-- =============== SEARCH & FILTER BAR =============== -->
<div class="bg-white p-6 rounded-xl shadow mb-8">
    <form action="{{ route('wisatas.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
        <!-- Search Input -->
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Wisata</label>
            <input
                type="text"
                name="q"
                value="{{ request('q', '') }}"
                placeholder="Nama, lokasi, atau kategori..."
                class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
            >
        </div>

        <!-- Category Filter -->
        <div class="md:w-48">
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select name="category" class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                <option value="">Semua Kategori</option>
                @forelse($categories as $cat)
                    <option value="{{ $cat->slug }}" @if(request('category') === $cat->slug) selected @endif>
                        {{ $cat->name }}
                    </option>
                @empty
                    <option value="">Alam</option>
                    <option value="">Kuliner</option>
                    <option value="">Modern</option>
                @endforelse
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 transition">
            🔍 Cari
        </button>
    </form>
</div>

<!-- =============== WISATA GRID =============== -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @forelse($wisatas ?? [] as $w)
        <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
            <!-- Image Container -->
            <a href="{{ route('wisatas.show', $w->slug) }}" class="block overflow-hidden h-44 bg-gray-200">
                <img
                    src="{{ $w->image ?? 'https://images.unsplash.com/photo-1469022563149-aa64dbd37dae?w=600&q=80&auto=format&fit=crop' }}"
                    alt="{{ $w->title }}"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                >
            </a>

            <!-- Card Content -->
            <div class="p-5 flex-1 flex flex-col">
                <!-- Title & Location -->
                <a href="{{ route('wisatas.show', $w->slug) }}" class="font-semibold text-lg text-gray-900 hover:text-blue-600 transition mb-1 line-clamp-2">
                    {{ $w->title }}
                </a>
                <div class="text-sm text-gray-500 flex items-center gap-1 mb-3">
                    📍 {{ $w->location ?? '-' }}
                </div>

                <!-- Category -->
                <div class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded w-fit mb-3">
                    {{ $w->category->name ?? 'Uncategorized' }}
                </div>

                <!-- Rating & Price Section -->
                <div class="flex items-center justify-between mb-4 text-sm border-t pt-3">
                    <div class="text-yellow-500 font-semibold">
                        @php
                            $avgRating = $w->reviews ? round($w->reviews()->avg('rating'), 1) : 0;
                            $reviewCount = $w->reviews ? $w->reviews()->count() : 0;
                        @endphp
                        ★ {{ $avgRating }} <span class="text-gray-500 font-normal">({{ $reviewCount }})</span>
                    </div>
                    <div class="text-gray-700 font-semibold">
                        Rp {{ number_format($w->price ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Button -->
                <a href="{{ route('wisatas.show', $w->slug) }}" class="mt-auto w-full bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition text-center">
                    Lihat Detail
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-3 bg-white p-16 rounded-lg text-center">
            <div class="text-6xl mb-4">🔍</div>
            <p class="text-gray-500 text-lg">Tidak ada wisata yang ditemukan.</p>
            <a href="{{ route('wisatas.index') }}" class="text-blue-600 mt-4 inline-block font-medium">Reset Filter →</a>
        </div>
    @endforelse
</div>

<!-- =============== PAGINATION =============== -->
@if(isset($wisatas) && $wisatas->count())
    <div class="mt-8">
        {{ $wisatas->links() }}
    </div>
@endif
@endsection
