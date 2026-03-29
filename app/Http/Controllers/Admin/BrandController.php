<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048'
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
            $brand->logo = $logoPath;
        }

        $brand->name = $request->name;
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return back()->with('success', 'Brand deleted');
    }
}