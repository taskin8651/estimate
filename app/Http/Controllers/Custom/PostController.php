<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // 📋 All Posts (Listing)
    public function index()
    {
        $posts = Post::where('status',1)->latest()->get();

        return view('custom.post', compact('posts'));
    }

    // 🔍 Single Post
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->firstOrFail();

        return view('custom.post-details', compact('post'));
    }
}