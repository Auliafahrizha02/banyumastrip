<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * HomeController: menampilkan homepage dengan wisata terbaru
 */
class HomeController extends Controller
{
    /**
     * Tampilkan homepage dengan wisata terbaru dan kategori populer
     */
    public function index(Request $request)
    {
        // Ambil wisata terbaru (published), eager load reviews
        $query = Wisata::with('category', 'reviews')
            ->where('published', true)
            ->orderBy('created_at', 'desc');

        // Search: cari berdasarkan title, location, atau category
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($q_builder) use ($q) {
                $q_builder->where('title', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%")
                    ->orWhereHas('category', function ($cat) use ($q) {
                        $cat->where('name', 'like', "%{$q}%");
                    });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $category = $request->input('category');
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category)->orWhere('id', $category);
            });
        }

        $wisatas = $query->paginate(6);

        // Get categories (max 5 populer)
        $categories = Category::limit(5)->get();
        
        // Total wisata untuk display
        $totalWisata = Wisata::where('published', true)->count();

        return view('home', compact('wisatas', 'categories', 'totalWisata'));
    }
}
