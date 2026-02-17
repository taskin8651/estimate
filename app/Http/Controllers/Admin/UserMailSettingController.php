<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserMailSettingController extends Controller
{
    public function index()
    {
        $setting = UserMailSetting::where('user_id', auth()->id())->first();
        return view('admin.mail_settings.index', compact('setting'));
    }

    public function create()
    {
        return view('admin.mail_settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
            'from_address' => 'required|email',
            'from_name' => 'required',
        ]);

        UserMailSetting::create([
            'user_id' => auth()->id(),
            'mailer' => 'smtp',
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => Crypt::encrypt($request->password),
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
            'from_name' => $request->from_name,
        ]);

        return redirect()->route('admin.mail-settings.index')
            ->with('success','Mail Setting Created');
    }

    public function edit(UserMailSetting $mail_setting)
    {
        $this->authorizeUser($mail_setting);
        return view('admin.mail_settings.edit', compact('mail_setting'));
    }

    public function update(Request $request, UserMailSetting $mail_setting)
    {
        $this->authorizeUser($mail_setting);

        $mail_setting->update([
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => Crypt::encrypt($request->password),
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
            'from_name' => $request->from_name,
        ]);

        return redirect()->route('admin.mail-settings.index')
            ->with('success','Mail Setting Updated');
    }

    public function destroy(UserMailSetting $mail_setting)
    {
        $this->authorizeUser($mail_setting);

        $mail_setting->delete();

        return back()->with('success','Mail Setting Deleted');
    }

    private function authorizeUser($mail_setting)
    {
        if ($mail_setting->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
