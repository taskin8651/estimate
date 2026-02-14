<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'nullable|email',
            'company_logo' => 'nullable|image|max:2048'
        ]);

        $setting = Setting::first();

        if ($request->hasFile('company_logo')) {

            $path = $request->file('company_logo')
                ->store('company', 'public');

            $setting->company_logo = $path;
        }

        $setting->update([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
        ]);

        $setting->save();

        return back()->with('success', 'Settings Updated Successfully');
    }
}
