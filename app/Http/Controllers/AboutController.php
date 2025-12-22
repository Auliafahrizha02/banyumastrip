<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page with city information
     */
    public function index()
    {
        $about = About::where('city', 'Banyumas')->first();

        return view('about.index', compact('about'));
    }
}
