<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store new gallery
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean'
        ]);

        $gallery = Gallery::create([
            'title' => $request->title,
            'status' => $request->status ?? 1,
        ]);

        // Upload image using Spatie
        if ($request->hasFile('image')) {
            $gallery->addMediaFromRequest('image')
                    ->toMediaCollection('gallery');
        }

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery created successfully');
    }

    /**
     * Show edit form
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update gallery
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean'
        ]);

        $gallery->update([
            'title' => $request->title,
            'status' => $request->status ?? 1,
        ]);

        // Replace image if new uploaded
        if ($request->hasFile('image')) {
            $gallery->clearMediaCollection('gallery');

            $gallery->addMediaFromRequest('image')
                    ->toMediaCollection('gallery');
        }

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery updated successfully');
    }

    /**
     * Delete gallery
     */
    public function destroy(Gallery $gallery)
    {
        // delete media automatically
        $gallery->clearMediaCollection('gallery');

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery deleted successfully');
    }

    /**
     * Optional: Toggle Status (AJAX ready)
     */
    public function toggleStatus(Gallery $gallery)
    {
        $gallery->status = !$gallery->status;
        $gallery->save();

        return response()->json([
            'success' => true,
            'status' => $gallery->status
        ]);
    }
}