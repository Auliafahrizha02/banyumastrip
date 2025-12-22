@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- =============== HERO SECTION - FULL WIDTH =============== -->
<section class="hero relative bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-2xl overflow-hidden shadow-2xl mb-12 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
    <div class="absolute inset-0 opacity-20 bg-pattern"></div>
    <div class="relative z-10 grid md:grid-cols-2 gap-8 items-center py-12 md:py-16">

        <!-- Left: Hero Text & Search -->
        <div>
            <!-- Badge -->
            <div class="inline-flex items-center bg-white/20 text-white px-4 py-2 rounded-full text-sm font-semibold mb-6 backdrop-blur-sm border border-white/30">
                ✨ Platform Wisata Terpercaya
            </div>

            <!-- Heading -->
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">
                Temukan Wisata <span class="text-blue-200">Terbaik</span> di Banyumas
            </h1>

            <!-- Subtitle -->
            <p class="text-blue-50 text-lg mb-8 leading-relaxed">
                Jelajahi destinasi wisata pilihan, baca ulasan pengguna, dapatkan informasi tiket masuk, dan rencakan perjalanan impianmu ke Banyumas.
            </p>

            <!-- Search Form -->
            <form action="{{ route('home') }}" method="GET" class="mb-8">
                <div class="flex flex-col sm:flex-row gap-3">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q', '') }}"
                        placeholder="Cari tempat, lokasi, atau kategori..."
                        class="flex-1 rounded-lg px-5 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 transition placeholder-gray-500"
                    >
                    <button type="submit" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg whitespace-nowrap">
                        🔍 Cari Sekarang
                    </button>
                </div>
            </form>

            <!-- Popular Categories Pills -->
            <div class="flex gap-3 flex-wrap">
                <span class="text-blue-100 text-sm font-medium pt-1">Kategori Populer:</span>
                @forelse($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat->slug]) }}" class="px-4 py-2 bg-white/20 hover:bg-white/40 text-white rounded-full text-sm font-medium transition backdrop-blur-sm border border-white/30">
                        {{ $cat->name }}
                    </a>
                @empty
                    <a href="{{ route('home', ['category' => 'alam']) }}" class="px-4 py-2 bg-white/20 hover:bg-white/40 text-white rounded-full text-sm font-medium transition backdrop-blur-sm border border-white/30">🏞️ Alam</a>
                    <a href="{{ route('home', ['category' => 'kuliner']) }}" class="px-4 py-2 bg-white/20 hover:bg-white/40 text-white rounded-full text-sm font-medium transition backdrop-blur-sm border border-white/30">🍜 Kuliner</a>
                @endforelse
            </div>

            <!-- CTA Button -->
            <div class="mt-8">
                <a href="{{ route('wisatas.index') }}" class="inline-flex items-center gap-2 bg-white text-blue-600 px-6 py-3 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg">
                    Jelajahi Semua Wisata →
                </a>
            </div>
        </div>

        <!-- Right: Hero Image -->
        <div class="hidden md:block relative h-96">
            <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-blue-900/50 rounded-xl overflow-hidden">
                <img
                    src="https://palpos.disway.id/upload/08f9e78495b4240b865ce2d276ead564.jpg"
                    alt="Banyumas Destination"
                    class="w-full h-full object-cover rounded-xl shadow-2xl hover:scale-105 transition-transform duration-500"
                >
            </div>
            <div class="absolute bottom-6 left-6 right-6 bg-black/40 backdrop-blur-md rounded-lg p-4 text-white border border-white/20">
                <div class="text-sm text-blue-100">Destinasi wisata alam dengan pemandangan menakjubkan di Banyumas</div>
            </div>
        </div>
    </div>
</section>

<!-- =============== LATEST WISATA GRID =============== -->
<section class="mb-12">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
        <div>
            <h2 class="text-4xl font-bold text-gray-900">✨ Wisata Terbaru</h2>
            <p class="text-gray-600 mt-2">Destinasi pilihan dan rekomendasi terpopuler dari pengguna BmsTrip</p>
        </div>
        <a href="{{ route('wisatas.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 text-lg">
            Lihat Semua Wisata →
        </a>
    </div>

    <!-- Cards Grid: responsive 1 column mobile, 2 tablet, 3 desktop -->
    <div class="cards-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($wisatas ?? [] as $w)
            <div class="card-item bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col transform hover:-translate-y-1">
                <!-- Image Container -->
                <a href="{{ route('wisatas.show', $w->slug) }}" class="block overflow-hidden h-56 bg-gradient-to-br from-gray-200 to-gray-300 relative group">
                    <img
                        src="{{ $w->image ?? 'https://images.unsplash.com/photo-1469022563149-aa64dbd37dae?w=600&q=80&auto=format&fit=crop' }}"
                        alt="{{ $w->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    >
                    <!-- Overlay Badge -->
                    @if($w->category)
                        <div class="absolute top-4 left-4 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            {{ $w->category->name }}
                        </div>
                    @endif

                    <!-- Quick View Button -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300 flex items-end">
                        <div class="w-full p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <button class="w-full bg-white text-blue-600 font-bold py-2 rounded-lg hover:bg-blue-50 transition">
                                👁️ Lihat Preview
                            </button>
                        </div>
                    </div>
                </a>

                <!-- Content -->
                <div class="p-5 flex-1 flex flex-col">
                    <!-- Title & Location -->
                    <a href="{{ route('wisatas.show', $w->slug) }}" class="font-bold text-lg text-gray-900 hover:text-blue-600 transition line-clamp-2 mb-2">
                        {{ $w->title }}
                    </a>

                    <div class="text-gray-600 flex items-center gap-1 mb-3 text-sm">
                        📍 {{ $w->location ?? '-' }}
                    </div>

                    <!-- Stats Row -->
                    <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                        <div class="flex items-center gap-1">
                            @php
                                $avgRating = $w->reviews ? round($w->reviews()->avg('rating'), 1) : 0;
                                $reviewCount = $w->reviews ? $w->reviews()->count() : 0;
                            @endphp
                            <span class="text-yellow-400 font-bold">★</span>
                            <span class="font-bold text-gray-900">{{ $avgRating }}</span>
                            <span class="text-gray-500 text-xs">({{ $reviewCount }} review)</span>
                        </div>
                        <div class="text-blue-600 font-bold text-lg">
                            Rp {{ number_format($w->price ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ route('wisatas.show', $w->slug) }}" class="mt-auto inline-block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold px-4 py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition text-center shadow-md hover:shadow-lg">
                        Lihat Detail Lengkap →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-gradient-to-r from-blue-50 to-indigo-50 p-12 rounded-2xl text-center border-2 border-blue-100">
                <div class="text-5xl mb-4">📍</div>
                <p class="text-gray-700 font-semibold text-lg">Belum ada wisata tersedia.</p>
                <p class="text-gray-500 mt-2">Kembali lagi nanti untuk melihat destinasi terbaru!</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($wisatas) && $wisatas->count())
        <div class="mt-10 flex justify-center">
            <div class="px-6 py-3 bg-white rounded-lg shadow-sm">
                {{ $wisatas->links() }}
            </div>
        </div>
    @endif
</section>
@endsection
