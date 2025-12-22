<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review for a wisata.
     * Requires authenticated user.
     */
    public function store(Request $request, $wisataId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000',
        ]);

        $user = Auth::user();
        if (! $user) {
            return redirect()->back()->withErrors(['auth' => 'You must be logged in to post a review.']);
        }

        $wisata = Wisata::findOrFail($wisataId);

        $review = Review::create([
            'wisata_id' => $wisata->id,
            'user_id' => $user->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('wisatas.show', $wisata->slug)->with('success', 'Review submitted.');
    }
}
