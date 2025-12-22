<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BmsTrip Admin - @yield('title', 'Dashboard')</title>
    <!-- Tailwind compiled CSS (dari Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r shadow-sm">
            <div class="p-6">
                <a href="{{ route('admin.wisatas.index') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-200 rounded flex items-center justify-center text-blue-700 font-bold">BT</div>
                    <div>
                        <h1 class="text-lg font-semibold">BmsTrip</h1>
                        <p class="text-sm text-gray-500">Admin Panel</p>
                    </div>
                </a>
            </div>

            <nav class="px-4 py-2">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.wisatas.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-blue-50">
                            <span class="text-blue-500">🏠</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.wisatas.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-blue-50">
                            <span class="text-blue-500">🗺️</span>
                            <span>Wisata</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-blue-50">
                            <span class="text-blue-500">📂</span>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-blue-50">
                            <span class="text-blue-500">👥</span>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.wisatas.index') }}#reviews" class="flex items-center gap-3 p-2 rounded hover:bg-blue-50">
                            <span class="text-blue-500">💬</span>
                            <span>Review</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Header / Navbar -->
            <header class="bg-white border-b p-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-gray-600">☰</button>
                    <h2 class="text-xl font-semibold">@yield('title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-sm text-gray-600">Admin</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded">Logout</button>
                    </form>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
