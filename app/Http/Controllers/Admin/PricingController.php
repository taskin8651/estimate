<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::latest()->get();
        return view('admin.pricing.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pricing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'nullable|string|max:50',
            'features' => 'nullable|array'
        ]);

        PricingPlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => $request->features,
        ]);

        return redirect()->route('pricing.index')->with('success', 'Plan created');
    }

    public function edit($id)
    {
        $plan = PricingPlan::findOrFail($id);
        return view('admin.pricing.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $plan = PricingPlan::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'nullable|string|max:50',
            'features' => 'nullable|array'
        ]);

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => $request->features,
        ]);

        return redirect()->route('pricing.index')->with('success', 'Plan updated');
    }

    public function destroy($id)
    {
        $plan = PricingPlan::findOrFail($id);
        $plan->delete();

        return back()->with('success', 'Plan deleted');
    }
}