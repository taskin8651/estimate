<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{
    // 🔹 List (only current user data)
    public function index()
    {
        $taxes = Tax::where('created_by', auth()->id())
                    ->latest()
                    ->get();

        return view('admin.tax.index', compact('taxes'));
    }

    // 🔹 Create Page
    public function create()
    {
        return view('admin.tax.create');
    }

    // 🔹 Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric|min:0|max:100',
            'type' => 'nullable|string',
            'country' => 'nullable|string'
        ]);

        Tax::create([
            'name' => strtoupper($request->name),
            'rate' => $request->rate,
            'type' => $request->type,
            'country' => $request->country,
            'is_default' => $request->has('is_default'),
            'status' => 1,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('admin.tax.index')
            ->with('success', 'Tax created successfully');
    }

    // 🔹 Edit
    public function edit($id)
    {
        $tax = Tax::where('created_by', auth()->id())
                  ->findOrFail($id);

        return view('admin.tax.edit', compact('tax'));
    }

    // 🔹 Update
    public function update(Request $request, $id)
    {
        $tax = Tax::where('created_by', auth()->id())
                  ->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric|min:0|max:100',
            'type' => 'nullable|string',
            'country' => 'nullable|string'
        ]);

        $tax->update([
            'name' => strtoupper($request->name),
            'rate' => $request->rate,
            'type' => $request->type,
            'country' => $request->country,
            'is_default' => $request->has('is_default'),
        ]);

        return redirect()->route('admin.tax.index')
            ->with('success', 'Tax updated successfully');
    }

    // 🔹 Delete
    public function destroy($id)
    {
        $tax = Tax::where('created_by', auth()->id())
                  ->findOrFail($id);

        $tax->delete();

        return redirect()->back()
            ->with('success', 'Tax deleted successfully');
    }
}