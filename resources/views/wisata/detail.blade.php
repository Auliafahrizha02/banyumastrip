@extends('layouts.app')

@section('title', $wisata->title ?? 'Detail Wisata')

@section('content')
<!-- =============== BREADCRUMB =============== -->
<div class="mb-6 flex items-center gap-2 text-sm text-gray-600">
    <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
    <span>/</span>
    <a href="{{ route('wisatas.index') }}" class="hover:text-blue-600 transition">Wisata</a>
    <span>/</span>
    <span class="text-gray-900 font-medium">{{ $wisata->title }}</span>
</div>

<!-- =============== MAIN CONTENT LAYOUT =============== -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- =============== LEFT COLUMN: IMAGES & DESCRIPTION =============== -->
    <div class="lg:col-span-2 space-y-8">

        <!-- Main Image -->
        <div class="rounded-xl overflow-hidden shadow-lg h-96 bg-gray-200">
            <img
                src="{{ $wisata->image ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=80&auto=format&fit=crop' }}"
                alt="{{ $wisata->title }}"
                class="w-full h-full object-cover"
            >
        </div>

        <!-- Wisata Header Info -->
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $wisata->title }}</h1>
                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <span>📍 {{ $wisata->location ?? 'Lokasi tidak tersedia' }}</span>
                        <span>📂 {{ $wisata->category->name ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Rating Summary -->
            @php
                $avgRating = $wisata->reviews ? round($wisata->reviews()->avg('rating'), 1) : 0;
                $reviewCount = $wisata->reviews ? $wisata->reviews()->count() : 0;
            @endphp
            <div class="flex items-center gap-3 text-lg font-semibold mb-4">
                <span class="text-yellow-500">★★★★★</span>
                <span class="text-gray-900">{{ $avgRating }}/5</span>
                <span class="text-gray-500 font-normal">({{ $reviewCount }} ulasan)</span>
            </div>
        </div>

        <!-- Description -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi</h3>
            <div class="text-gray-700 leading-relaxed space-y-3">
                {!! nl2br(e($wisata->description ?? 'Deskripsi belum tersedia.')) !!}
            </div>
        </div>

        <!-- =============== REVIEWS SECTION =============== -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Ulasan Pengguna</h3>

            @if($wisata->reviews && $wisata->reviews()->count() > 0)
                <!-- Reviews List -->
                <div class="space-y-4 mb-6">
                    @foreach($wisata->reviews()->latest()->get() as $review)
                        <div class="border-b pb-4 last:border-b-0">
                            <!-- Reviewer Header -->
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $review->user->name ?? 'Pengguna' }}</div>
                                    <div class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="text-yellow-500 font-semibold text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                    {{ $review->rating }}/5
                                </div>
                            </div>

                            <!-- Review Comment -->
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $review->comment ?? '(Tanpa komentar)' }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 p-6 rounded-lg text-center mb-6">
                    <p class="text-gray-500">Belum ada ulasan. Jadilah yang pertama memberikan ulasan!</p>
                </div>
            @endif

            <!-- =============== REVIEW FORM (Auth Only) =============== -->
            <div class="border-t pt-6">
                @auth
                    <h4 class="font-semibold text-gray-900 mb-4">Tulis Ulasan Anda</h4>
                    <form action="{{ route('reviews.store', $wisata->id) }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Rating Select -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <select name="rating" required class="w-full md:w-48 rounded-lg border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                                <option value="">Pilih Rating...</option>
                                <option value="5">⭐⭐⭐⭐⭐ Sangat Bagus (5)</option>
                                <option value="4">⭐⭐⭐⭐ Bagus (4)</option>
                                <option value="3">⭐⭐⭐ Cukup (3)</option>
                                <option value="2">⭐⭐ Kurang (2)</option>
                                <option value="1">⭐ Buruk (1)</option>
                            </select>
                            @error('rating')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Comment Textarea -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
                            <textarea
                                name="comment"
                                rows="4"
                                placeholder="Bagikan pengalamanmu di tempat wisata ini..."
                                class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition resize-none"
                            ></textarea>
                            @error('comment')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 transition">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                        <p class="text-blue-800 text-sm">
                            <a href="{{ route('login') }}" class="font-semibold hover:underline">Masuk</a>
                            atau
                            <a href="{{ route('register') }}" class="font-semibold hover:underline">Daftar</a>
                            untuk meninggalkan ulasan.
                        </p>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- =============== RIGHT COLUMN: SIDEBAR =============== -->
    <aside class="lg:col-span-1 space-y-6">

        <!-- =============== INFO BOX =============== -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 sticky top-20">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tiket</h4>

            <!-- Price -->
            <div class="mb-4 pb-4 border-b">
                <div class="text-sm text-gray-600 mb-1">Harga Tiket Masuk</div>
                <div class="text-3xl font-bold text-blue-600">
                    Rp {{ number_format($wisata->price ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <!-- Opening Hours -->
            <div class="mb-4 pb-4 border-b">
                <div class="text-sm text-gray-600 mb-1">Jam Operasional</div>
                <div class="font-semibold text-gray-900">{{ $wisata->opening_hours ?? '08:00 - 17:00' }}</div>
            </div>


        <!-- =============== RECOMMENDATIONS =============== -->
        @if($recommendations && $recommendations->count() > 0)
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="font-semibold text-gray-900 mb-4">Kamu Mungkin Juga Suka</h4>
                <div class="space-y-3">
                    @foreach($recommendations as $rec)
                        <a href="{{ route('wisatas.show', $rec->slug) }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 transition">
                            <div class="w-16 h-12 bg-gray-200 overflow-hidden rounded flex-shrink-0">
                                <img
                                    src="{{ $rec->image ?? 'https://images.unsplash.com/photo-1469022563149-aa64dbd37dae?w=200&q=80&auto=format&fit=crop' }}"
                                    alt="{{ $rec->title }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 line-clamp-1">{{ $rec->title }}</div>
                                <div class="text-xs text-gray-500">{{ $rec->location ?? '' }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </aside>
</div>
@endsection
