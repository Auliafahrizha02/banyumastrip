@extends('layouts.app')

@section('title', 'Tentang Banyumas')

@section('content')
<!-- =============== HERO SECTION =============== -->
<section class="hero relative bg-gradient-to-r from-green-600 to-emerald-800 text-white rounded-2xl overflow-hidden shadow-2xl mb-12 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
    <div class="absolute inset-0 opacity-20 bg-pattern"></div>
    <div class="relative z-10 py-12 md:py-16">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">🌍 Tentang Banyumas</h1>
        <p class="text-green-100 text-lg max-w-2xl">
            Jelajahi sejarah, budaya, dan keindahan alam dari salah satu kota paling menarik di Jawa Tengah
        </p>
    </div>
</section>

<!-- =============== ABOUT CONTENT =============== -->
@if($about)
    <section class="mb-12">
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100">
            <div class="grid md:grid-cols-2 gap-0">
                <!-- Image Side -->
                <div class="overflow-hidden h-96 md:h-auto bg-gray-200 relative group">
                    <img
                        src="{{ $about->image ?? 'https://1.bp.blogspot.com/-XBack8WAWQE/YBloIZMVFYI/AAAAAAAABbo/81Car6i_PV4u1hSNF8NgNG38tzHSSFGMACNcBGAsYHQ/s2048/Kab.Banyumas1.jpg' }}"
                        alt="{{ $about->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                    <!-- Overlay Badge -->
                    <div class="absolute top-6 left-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-full font-bold shadow-lg">
                        📍 {{ $about->city }}
                    </div>
                </div>

                <!-- Content Side -->
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $about->title }}</h2>
                    
                    <div class="prose prose-lg max-w-none text-gray-700 space-y-4">
                        {!! nl2br(e($about->description)) !!}
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <a href="{{ route('wisatas.index') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-3 rounded-lg font-bold hover:from-green-600 hover:to-emerald-700 transition shadow-lg">
                            🗺️ Jelajahi Wisata
                        </a>
                        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 bg-white border-2 border-green-500 text-green-600 px-8 py-3 rounded-lg font-bold hover:bg-green-50 transition">
                            ← Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <!-- Empty State -->
    <section class="mb-12">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-12 rounded-2xl text-center border-2 border-green-100">
            <div class="text-5xl mb-4">📍</div>
            <p class="text-gray-700 font-semibold text-lg">Data tentang Banyumas belum tersedia.</p>
            <p class="text-gray-500 mt-2">Silakan hubungi admin untuk menambahkan informasi.</p>
            <a href="{{ route('home') }}" class="mt-6 inline-block bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    </section>
@endif

<!-- =============== QUICK STATS =============== -->
<section class="mb-12">
    <div class="grid md:grid-cols-4 gap-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-8 rounded-xl shadow-lg text-center">
            <div class="text-4xl mb-3">📊</div>
            <div class="text-3xl font-bold">20+</div>
            <div class="text-blue-100 mt-2">Destinasi Wisata</div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white p-8 rounded-xl shadow-lg text-center">
            <div class="text-4xl mb-3">👥</div>
            <div class="text-3xl font-bold">1000+</div>
            <div class="text-green-100 mt-2">Pengunjung Aktif</div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-8 rounded-xl shadow-lg text-center">
            <div class="text-4xl mb-3">⭐</div>
            <div class="text-3xl font-bold">4.5+</div>
            <div class="text-purple-100 mt-2">Rating Rata-rata</div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-red-600 text-white p-8 rounded-xl shadow-lg text-center">
            <div class="text-4xl mb-3">📸</div>
            <div class="text-3xl font-bold">500+</div>
            <div class="text-orange-100 mt-2">Review & Foto</div>
        </div>
    </div>
</section>

<!-- =============== WHY CHOOSE BANYUMAS =============== -->
<section class="mb-12">
    <div class="text-center mb-12">
        <h3 class="text-4xl font-bold text-gray-900 mb-4">🎯 Mengapa Memilih Banyumas?</h3>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Sejumlah alasan kenapa Banyumas menjadi destinasi wisata favorit</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100">
            <div class="text-5xl mb-4">🏔️</div>
            <h4 class="text-xl font-bold text-gray-900 mb-3">Alam yang Indah</h4>
            <p class="text-gray-600">Pemandangan alam yang menakjubkan dengan gunung, air terjun, dan danau yang memukau.</p>
        </div>

        <!-- Feature 2 -->
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100">
            <div class="text-5xl mb-4">🍜</div>
            <h4 class="text-xl font-bold text-gray-900 mb-3">Kuliner Autentik</h4>
            <p class="text-gray-600">Cita rasa tradisional Banyumas yang lezat dan autentik, warisan budaya yang kaya.</p>
        </div>

        <!-- Feature 3 -->
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100">
            <div class="text-5xl mb-4">🏛️</div>
            <h4 class="text-xl font-bold text-gray-900 mb-3">Warisan Budaya</h4>
            <p class="text-gray-600">Kaya akan sejarah, seni, dan tradisi yang telah dilestarikan turun-temurun.</p>
        </div>

        <!-- Feature 4 -->
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100">
            <div class="text-5xl mb-4">🧖</div>
            <h4 class="text-xl font-bold text-gray-900 mb-3">Relaksasi & Kenyamanan</h4>
            <p class="text-gray-600">Berbagai tempat relaksasi dan akomodasi nyaman untuk liburan yang sempurna.</p>
        </div>

        <!-- Feature 5 -->
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100">
            <div class="text-5xl mb-4">🚗</div>
            <h4 class="text-xl font-bold text-gray-900 mb-3">Akses Mudah</h4>
            <p class="text-gray-600">Lokasi strategis dengan akses transportasi yang mudah dari berbagai kota.</p>
        </div>

        <!-- Feature 6 -->
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100">
            <div class="text-5xl mb-4">💰</div>
            <h4 class="text-xl font-bold text-gray-900 mb-3">Harga Terjangkau</h4>
            <p class="text-gray-600">Destinasi wisata berkualitas dengan harga yang sangat terjangkau untuk semua kalangan.</p>
        </div>
    </div>
</section>

<!-- =============== CTA SECTION =============== -->
<section class="mb-12">
    <div class="bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-2xl p-12 shadow-xl text-center">
        <h3 class="text-4xl font-bold mb-4">Siap Menjelajahi Banyumas?</h3>
        <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">
            Temukan destinasi wisata terbaik di Banyumas dan buat kenangan indah bersama keluarga dan teman-teman.
        </p>
        <a href="{{ route('wisatas.index') }}" class="inline-flex items-center gap-2 bg-white text-green-600 px-8 py-3 rounded-lg font-bold hover:bg-green-50 transition shadow-lg">
            🗺️ Lihat Semua Wisata
        </a>
    </div>
</section>

@endsection
