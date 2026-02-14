<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::where('created_by', auth()->id())->first();

        if (!$setting) {
            $setting = Setting::create([
                'created_by' => auth()->id()
            ]);
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

        $setting = Setting::where('created_by', auth()->id())->first();

        if (!$setting) {
            $setting = Setting::create([
                'created_by' => auth()->id()
            ]);
        }

        $data = [
            'company_name'   => $request->company_name,
            'company_email'  => $request->company_email,
            'company_phone'  => $request->company_phone,
            'company_address'=> $request->company_address,
        ];

        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')
                                ->store('company', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Settings Updated Successfully');
    }
}
