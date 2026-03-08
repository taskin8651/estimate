<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{

    public function index()
    {
        $taxes = Tax::with('creator')->latest()->get();
        return view('admin.tax.index', compact('taxes'));
    }


    public function create()
    {
        return view('admin.tax.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric'
        ]);

        Tax::create([
            'name' => strtoupper($request->name),
            'rate' => $request->rate,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('admin.tax.index')
            ->with('success', 'Tax created successfully');
    }


    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        return view('admin.tax.edit', compact('tax'));
    }


    public function update(Request $request, $id)
    {
        $tax = Tax::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric'
        ]);

        $tax->update([
            'name' => strtoupper($request->name),
            'rate' => $request->rate,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('admin.tax.index')
            ->with('success', 'Tax updated successfully');
    }


    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();

        return redirect()->back()
            ->with('success', 'Tax deleted successfully');
    }

}