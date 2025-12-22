<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BmsTrip - @yield('title', 'Jelajah Banyumas')</title>

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind compiled CSS (dari Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Fallback styles when Tailwind/build isn't available. Keeps UI presentable. */
        :root{
            --bg:#f7fafc;
            --muted:#6b7280;
            --primary:#2563eb;
            --primary-600:#1d4ed8;
            --card:#ffffff;
            --accent:#f59e0b;
        }

        html,body{height:100%;}
        body {
            margin:0;
            font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background: var(--bg);
            color: #111827;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }

        /* Header / Navbar fallback */
        header{background:#fff;border-bottom:1px solid #e6edf3;box-shadow:0 1px 4px rgba(15,23,42,0.03);}
        header .max-w-7xl{display:flex;align-items:center;justify-content:space-between;padding:12px 16px;}
        header a{color:var(--primary);text-decoration:none}
        header nav a{margin:0 10px;color:#374151;font-weight:600;text-decoration:none}
        header nav a:hover{color:var(--primary-600)}

        /* Hero */
        .hero{max-width:1100px;margin:28px auto;padding:28px;background:linear-gradient(90deg, #1e40af 0%, #2563eb 100%);color:white;border-radius:12px;box-shadow:0 10px 30px rgba(37,99,235,0.08);}
        .hero .badge{display:inline-block;background:rgba(255,255,255,0.15);padding:6px 12px;border-radius:999px;margin-bottom:12px;font-weight:600}
        .hero h1{font-size:2.25rem;margin:8px 0 12px;line-height:1.05}
        .hero p{color:rgba(255,255,255,0.9);margin-bottom:16px}
        .hero form{display:flex;gap:8px}
        .hero input[type="text"]{flex:1;padding:12px 14px;border-radius:10px;border:1px solid rgba(255,255,255,0.12);background:rgba(255,255,255,0.95)}
        .hero button{background:white;color:var(--primary);border:none;padding:10px 18px;border-radius:10px;font-weight:700}

        /* Grid / Cards fallback */
        .cards-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;margin-top:22px}
        .card-item{background:var(--card);border-radius:12px;overflow:hidden;box-shadow:0 6px 18px rgba(15,23,42,0.06);display:flex;flex-direction:column}
        .card-item img{width:100%;height:200px;object-fit:cover;display:block}
        .card-item .card-body{padding:14px;flex:1;display:flex;flex-direction:column}
        .card-item h3{margin:0 0 8px;font-size:1.05rem}
        .card-item .meta{color:var(--muted);font-size:0.9rem;margin-bottom:8px}
        .card-item .price{font-weight:700;color:var(--primary);margin-left:auto}
        .card-item .cta{display:inline-block;background:linear-gradient(90deg,var(--primary),var(--primary-600));color:white;padding:10px 12px;border-radius:10px;text-align:center;text-decoration:none;margin-top:12px}

        /* Footer */
        footer{margin-top:28px;background:#fff;border-top:1px solid #eef2f7;padding:18px}

        /* Responsive small tweaks */
        @media (max-width:640px){
            .hero h1{font-size:1.5rem}
            header .max-w-7xl{padding:10px}
            .hero{margin:16px;padding:16px}
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- =============== HEADER / NAVBAR =============== -->
    <header class="bg-white border-b shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 hover:opacity-80 transition transform hover:scale-105">
                    <div class="w-11 h-11 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-base shadow-lg">
                        BT
                    </div>
                    <div>
                        <div class="text-lg font-bold text-gray-900">BmsTrip</div>
                        <div class="text-xs text-gray-500 font-medium">Jelajah Banyumas</div>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="{{ route('wisatas.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Semua Wisata</a>
                    <a href="{{ route('about.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Tentang</a>
                </nav>

                <!-- Auth Links / User Menu -->
                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition shadow-md hover:shadow-lg">Daftar</a>
                    @else
                        <div class="flex items-center gap-4">
                            <!-- User Name -->
                            <div class="text-sm font-medium text-gray-700">
                                👤 {{ auth()->user()->name }}
                            </div>

                            <!-- Admin Dashboard Button (if admin) -->
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ url('/admin/wisatas') }}" class="text-sm font-bold bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition shadow-md hover:shadow-lg">
                                    ⚙️ Admin Panel
                                </a>
                            @endif

                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-medium bg-red-50 text-red-600 px-4 py-2 rounded-lg hover:bg-red-100 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- =============== MAIN CONTENT =============== -->
    <main class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- =============== FOOTER =============== -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-sm text-gray-500">
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div>
                    <div class="font-semibold text-gray-700 mb-2">BmsTrip</div>
                    <p class="text-xs">Platform rekomendasi wisata untuk Banyumas.</p>
                </div>
                <div>
                    <div class="font-semibold text-gray-700 mb-2">Link</div>
                    <ul class="text-xs space-y-1">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
                        <li><a href="{{ route('wisatas.index') }}" class="hover:text-blue-600">Wisata</a></li>
                    </ul>
                </div>
                <div>
                    <div class="font-semibold text-gray-700 mb-2">Info</div>
                    <p class="text-xs">© {{ date('Y') }} BmsTrip — Demo untuk pembelajaran.</p>
                </div>
            </div>
            <div class="border-t pt-4 text-center">
                <p class="text-xs">Dibuat dengan ❤️ untuk mahasiswa</p>
            </div>
        </div>
    </footer>
</body>
</html>
