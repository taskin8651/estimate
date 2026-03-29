<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::orderBy('order')->get();
        return view('admin.pricing.index', compact('plans'));
    }

    public function create()
    {
        // limit 3 plans
        if (PricingPlan::count() >= 3) {
            return redirect()->route('admin.pricing.index')
                ->with('error', 'Only 3 plans allowed');
        }

        return view('admin.pricing.create');
    }

    public function store(Request $request)
    {
        // limit 3 plans
        if (PricingPlan::count() >= 3) {
            return back()->with('error', 'Only 3 plans allowed');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'nullable|string|max:50',
            'type' => 'required|in:intro,popular,pro',
            'features' => 'nullable|array',
            'order' => 'nullable|integer'
        ]);

        PricingPlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'type' => $request->type,
            'features' => $request->features,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Plan created');
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
            'type' => 'required|in:intro,popular,pro',
            'features' => 'nullable|array',
            'order' => 'nullable|integer'
        ]);

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'type' => $request->type,
            'features' => $request->features,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Plan updated');
    }

    public function destroy($id)
    {
        $plan = PricingPlan::findOrFail($id);
        $plan->delete();

        return back()->with('success', 'Plan deleted');
    }
}