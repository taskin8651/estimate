<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = HeroSection::latest()->get();
        return view('admin.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hero', 'public');
        }

        HeroSection::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Hero created successfully');
    }

    public function edit($id)
    {
        $hero = HeroSection::findOrFail($id);
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        $hero = HeroSection::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hero', 'public');
            $hero->image = $imagePath;
        }

        $hero->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Hero updated');
    }

    public function destroy($id)
    {
        $hero = HeroSection::findOrFail($id);
        $hero->delete();

        return back()->with('success', 'Hero deleted');
    }
}