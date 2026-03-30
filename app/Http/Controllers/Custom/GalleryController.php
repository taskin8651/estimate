<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        // sirf active images
        $galleries = Gallery::where('status', 1)->latest()->get();

        return view('custom.gallery', compact('galleries'));
    }
}