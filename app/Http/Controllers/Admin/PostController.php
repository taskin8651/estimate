<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // 📋 All Posts
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    // ➕ Create Page
    public function create()
    {
        return view('admin.posts.create');
    }

    // 💾 Store Post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => 1
        ]);

        // 🖼️ Multiple Images Upload
         if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $post->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post Created');
    }

    // ✏️ Edit Page
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

 

public function update(Request $request, Post $post)
{
    // ✅ Validation
    $request->validate([
        'title' => 'required',
        'content' => 'nullable',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096'
    ]);

    // ✅ Update Post
    $post->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'content' => $request->content,
    ]);

    // ❌ DELETE selected images
    if ($request->has('delete_images')) {
        foreach ($request->delete_images as $mediaId) {
            $media = Media::find($mediaId);

            // extra safety (sirf isi post ka media delete ho)
            if ($media && $media->model_id == $post->id) {
                $media->delete();
            }
        }
    }

    // 🖼️ ADD new images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            if ($image->isValid()) {
                $post->addMedia($image)->toMediaCollection('images');
            }
        }
    }

    return redirect()
        ->route('admin.posts.index')
        ->with('success', 'Post Updated Successfully');
}

    // ❌ Delete Post
    public function destroy(Post $post)
    {
        // delete all media also
        $post->clearMediaCollection('images');
        $post->delete();

        return back()->with('success', 'Post Deleted');
    }
}