<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

// Public homepage shows list of wisata recommendations
Route::get('/', [HomeController::class, 'index'])->name('home');

// About page - show city information
Route::get('/tentang', [AboutController::class, 'index'])->name('about.index');

// Wisata detail route (slug-based)
Route::get('/wisatas/{slug}', [WisataController::class, 'show'])->name('wisatas.show');

// Wisata listing route
Route::get('/wisata', [WisataController::class, 'index'])->name('wisatas.index');

// Store review (requires authentication)
Route::post('/wisatas/{wisata}/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store')
    ->middleware('auth');

// Admin routes: protected by auth and is_admin middleware
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', \App\Http\Middleware\IsAdmin::class])
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Categories
        Route::get('categories', [AdminController::class, 'categoriesIndex'])->name('categories.index');
        Route::post('categories', [AdminController::class, 'categoriesStore'])->name('categories.store');
        Route::put('categories/{category}', [AdminController::class, 'categoriesUpdate'])->name('categories.update');
        Route::delete('categories/{category}', [AdminController::class, 'categoriesDestroy'])->name('categories.destroy');

        // Wisatas
        Route::get('wisatas', [AdminController::class, 'wisatasIndex'])->name('wisatas.index');
        Route::get('wisatas/create', [AdminController::class, 'wisatasCreate'])->name('wisatas.create');
        Route::post('wisatas', [AdminController::class, 'wisatasStore'])->name('wisatas.store');
        Route::put('wisatas/{wisata}', [AdminController::class, 'wisatasUpdate'])->name('wisatas.update');
        Route::delete('wisatas/{wisata}', [AdminController::class, 'wisatasDestroy'])->name('wisatas.destroy');

        // Users
        Route::get('users', [AdminController::class, 'usersIndex'])->name('users.index');
        Route::put('users/{user}', [AdminController::class, 'usersUpdate'])->name('users.update');
        Route::delete('users/{user}', [AdminController::class, 'usersDestroy'])->name('users.destroy');

        // About page
        Route::get('about', [AdminController::class, 'aboutEdit'])->name('about.edit');
        Route::put('about', [AdminController::class, 'aboutUpdate'])->name('about.update');
    });

// ==================== AUTHENTICATION ROUTES ====================
// Simple authentication routes tanpa Breeze
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
})->name('login.store')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $validated['password'] = bcrypt($validated['password']);
    $validated['role'] = 'user';

    \App\Models\User::create($validated);

    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
})->name('register.store')->middleware('guest');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');
