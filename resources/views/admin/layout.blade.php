<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BmsTrip Admin - @yield('title', 'Dashboard')</title>
    <!-- Tailwind compiled CSS (dari Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 border-r-2 border-blue-700 shadow-xl">
            <div class="p-6 border-b border-blue-700">
                <a href="{{ route('admin.wisatas.index') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-amber-500 rounded flex items-center justify-center text-blue-900 font-bold shadow-md">BT</div>
                    <div>
                        <h1 class="text-lg font-bold text-white">BmsTrip</h1>
                        <p class="text-xs text-blue-200">Admin Panel</p>
                    </div>
                </a>
            </div>

            <nav class="px-4 py-4 space-y-1">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.wisatas.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition duration-200 font-medium">
                            <span>🏠</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.wisatas.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition duration-200 font-medium">
                            <span>🗺️</span>
                            <span>Wisata</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition duration-200 font-medium">
                            <span>📂</span>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition duration-200 font-medium">
                            <span>👥</span>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.wisatas.index') }}#reviews" class="flex items-center gap-3 p-3 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition duration-200 font-medium">
                            <span>💬</span>
                            <span>Review</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Header / Navbar -->
            <header class="bg-white border-b-2 border-gray-200 p-4 flex items-center justify-between shadow-md">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-gray-600">☰</button>
                    <h2 class="text-2xl font-bold text-gray-900">@yield('title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-lg font-semibold">👤 Admin</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg font-bold hover:from-red-600 hover:to-red-700 transition shadow-md">Logout</button>
                    </form>
                </div>
            </header>

            <main class="p-8 overflow-auto flex-1">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
