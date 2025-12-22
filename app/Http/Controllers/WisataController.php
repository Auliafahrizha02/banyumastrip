<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Display a listing of wisata. Supports simple pagination and optional category filter.
     */
    public function index(Request $request)
    {
        $query = Wisata::with('category', 'reviews')
            ->where('published', true)
            ->orderBy('created_at', 'desc');

        // Filter by search query (judul, lokasi, atau kategori)
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

        // Filter by category slug or ID
        if ($request->filled('category')) {
            $category = $request->input('category');
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category)->orWhere('id', $category);
            });
        }

        $wisatas = $query->paginate(9);

        // Get categories for sidebar
        $categories = \App\Models\Category::all();

        return view('wisata.index', compact('wisatas', 'categories'));
    }

    /**
     * Show the detail of a single wisata including its reviews.
     */
    public function show($slug)
    {
        $wisata = Wisata::with(['category', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get recommendations: wisatas dari kategori yang sama (exclude current)
        $recommendations = Wisata::with('reviews')
            ->where('category_id', $wisata->category_id)
            ->where('id', '!=', $wisata->id)
            ->where('published', true)
            ->limit(3)
            ->get();

        return view('wisata.detail', compact('wisata', 'recommendations'));
    }
}
