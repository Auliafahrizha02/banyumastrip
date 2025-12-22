<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use App\Models\Wisata;
use App\Models\About;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard - show stats and recent reviews
     */
    public function dashboard()
    {
        $wisataCount = Wisata::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $recentReviews = Review::with(['user', 'wisata'])->latest()->limit(5)->get();

        return view('admin.dashboard', compact('wisataCount', 'categoryCount', 'userCount', 'recentReviews'));
    }

    // -------------------- Categories --------------------
    /**
     * List categories for admin management.
     */
    public function categoriesIndex()
    {
        $categories = Category::orderBy('name')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a new category.
     */
    public function categoriesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
        ]);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    /**
     * Update an existing category.
     */
    public function categoriesUpdate(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    /**
     * Delete a category.
     */
    public function categoriesDestroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }

    // -------------------- Wisatas --------------------
    /**
     * List wisatas for admin management.
     */
    public function wisatasIndex()
    {
        $wisatas = Wisata::with('category')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.wisatas.index', compact('wisatas'));
    }

    /**
     * Show form to create new wisata.
     */
    public function wisatasCreate()
    {
        $categories = Category::all();
        return view('admin.wisatas.create', compact('categories'));
    }

    /**
     * Store a new wisata.
     */
    public function wisatasStore(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:wisatas,slug',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|string',
            'published' => 'sometimes|boolean',
        ]);

        Wisata::create($data);

        return redirect()->route('admin.wisatas.index')->with('success', 'Wisata berhasil ditambahkan!');
    }

    /**
     * Update an existing wisata.
     */
    public function wisatasUpdate(Request $request, Wisata $wisata)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:wisatas,slug,' . $wisata->id,
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'published' => 'sometimes|boolean',
        ]);

        $wisata->update($data);

        return redirect()->route('admin.wisatas.index')->with('success', 'Wisata updated.');
    }

    /**
     * Delete a wisata.
     */
    public function wisatasDestroy(Wisata $wisata)
    {
        $wisata->delete();
        return redirect()->route('admin.wisatas.index')->with('success', 'Wisata deleted.');
    }

    // -------------------- Users --------------------
    /**
     * List users.
     */
    public function usersIndex()
    {
        $users = User::orderBy('name')->paginate(50);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Update user's role.
     */
    public function usersUpdate(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => 'required|string|in:user,admin',
        ]);

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    /**
     * Delete a user.
     */
    public function usersDestroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }

    // -------------------- About --------------------
    /**
     * Edit about page (Tentang)
     */
    public function aboutEdit()
    {
        $about = About::where('city', 'Banyumas')->first();
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update about page
     */
    public function aboutUpdate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
        ]);

        $about = About::where('city', 'Banyumas')->first();
        
        if (!$about) {
            $about = About::create(array_merge($data, ['city' => 'Banyumas']));
        } else {
            $about->update($data);
        }

        return redirect()->route('admin.about.edit')->with('success', '✅ Halaman tentang berhasil diperbarui!');
    }
}
