<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
use App\Models\Client;
use App\Models\EstimateItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UserMailSetting;
use Illuminate\Support\Facades\Crypt;
use App\Models\Tax;


use App\Mail\EstimateMail;
use Illuminate\Support\Facades\Mail;


class EstimateController extends Controller
{
    // 📌 Estimate List
 public function index()
{
    $estimates = Estimate::with('client')
                    ->where('created_by', auth()->id())
                    ->latest()
                    ->paginate(10);

    return view('admin.estimates.index', compact('estimates'));
}


    // 📌 Create Page
    public function create()
{
    $clients = Client::where('created_by', auth()->id())
                    ->pluck('name', 'id');

    $taxes = Tax::where('created_by', auth()->id())->get();

    return view('admin.estimates.create', compact('clients', 'taxes'));
}


    // 📌 Store Estimate
   public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'client_id' => 'required',
        'issue_date' => 'required|date',
        'items' => 'required|array'
    ]);


    // 🔹 Auto Estimate Number
    $last = Estimate::latest()->first();
    $number = $last ? $last->id + 1 : 1;
    $estimateNumber = 'EST-' . str_pad($number, 4, '0', STR_PAD_LEFT);


    // 🔹 Calculate Subtotal
    $subtotal = 0;

    foreach ($request->items as $item) {

        $qty = $item['quantity'] ?? 0;
        $rate = $item['rate'] ?? 0;

        $subtotal += ($qty * $rate);
    }


    // 🔹 Calculate Taxes
    $taxAmount = 0;

    if ($request->taxes) {

        foreach ($request->taxes as $taxId) {

            $tax = Tax::find($taxId);

            if ($tax) {

                $amount = ($subtotal * $tax->rate) / 100;

                $taxAmount += $amount;

                $taxData[] = [
                    'tax_id' => $tax->id,
                    'amount' => $amount
                ];
            }
        }
    }


    // 🔹 Grand Total
    $total = $subtotal + $taxAmount;


    // 🔹 Create Estimate
    $estimate = Estimate::create([
        'estimate_number' => $estimateNumber,
        'client_id' => $request->client_id,
        'issue_date' => $request->issue_date,
        'expiry_date' => $request->expiry_date,
        'subtotal' => $subtotal,
        'tax_amount' => $taxAmount,
        'total' => $total,
        'status' => 'draft',
        'notes' => $request->notes,
        'created_by' => Auth::id(),
    ]);


    // 🔹 Save Items
    foreach ($request->items as $item) {

        $qty = $item['quantity'] ?? 0;
        $rate = $item['rate'] ?? 0;

        EstimateItem::create([
            'estimate_id' => $estimate->id,
            'title' => $item['title'] ?? null,
            'description' => $item['description'] ?? null,
            'quantity' => $qty,
            'rate' => $rate,
            'amount' => $qty * $rate,
        ]);
    }


    // 🔹 Save Taxes (pivot table)
    if (!empty($taxData)) {

        foreach ($taxData as $tax) {

            $estimate->taxes()->attach($tax['tax_id'], [
                'amount' => $tax['amount']
            ]);

        }

    }


    return redirect()
        ->route('admin.estimates.index')
        ->with('success', 'Estimate Created Successfully');
}

    // 📌 Show
public function show(Estimate $estimate)
{
    if ($estimate->created_by != auth()->id()) {
        abort(403);
    }

    $estimate->load('client','items','taxes');

    $setting = Setting::where('created_by', auth()->id())->first();

    // template name
    $template = $estimate->template ?? 'classic';

    // theme config
    $theme = config('estimate_themes.' . $template)
            ?? config('estimate_themes.classic');

    return view('admin.estimates.templates.master', compact(
        'estimate',
        'setting',
        'theme',
        'template'
    ));
}





    // 📌 Delete
    public function destroy(Estimate $estimate)
    {
        $estimate->delete();
        return back()->with('success', 'Estimate Deleted');
    }


public function downloadPdf($id)
{
    $estimate = Estimate::with(['items','client','creator','taxes'])
                        ->findOrFail($id);

    // Get setting based on estimate creator
    $setting = Setting::where('created_by', $estimate->created_by)->first();

    if (!$setting) {
        $setting = Setting::first();
    }

    // Template name
    $template = $estimate->template ?? 'classic';

    // Load PDF theme config
    $theme = config('estimate_pdf_themes.' . $template)
            ?? config('estimate_pdf_themes.classic');

    $pdf = Pdf::loadView('admin.estimates.pdf.master', [
        'estimate' => $estimate,
        'setting' => $setting,
        'theme' => $theme,
        'template' => $template
    ])
    ->setPaper('a4', 'portrait')
    ->setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
        'defaultFont' => 'DejaVu Sans',
        'dpi' => 120
    ]);

    return $pdf->download('Estimate-'.$estimate->estimate_number.'.pdf');
}


public function sendEstimate(Estimate $estimate)
{
    $estimate->load('client','items','taxes');

    // 🔹 Get logged-in user's SMTP
    $setting = UserMailSetting::where('user_id', auth()->id())->first();

    if($setting){
        config([
            'mail.mailers.smtp.host' => $setting->host,
            'mail.mailers.smtp.port' => $setting->port,
            'mail.mailers.smtp.encryption' => $setting->encryption,
            'mail.mailers.smtp.username' => $setting->username,
            'mail.mailers.smtp.password' => Crypt::decrypt($setting->password),
            'mail.from.address' => $setting->from_address,
            'mail.from.name' => $setting->from_name,
        ]);
    }

    // 🔹 Send mail
    Mail::to($estimate->client->email)
        ->send(new EstimateMail($estimate));

    $estimate->update([
        'status' => 'sent'
    ]);

    return back()->with('success','Estimate Sent Successfully');
}



public function changeTemplate(Request $request, Estimate $estimate)
{
    $estimate->update([
        'template' => $request->template
    ]);

    return back();
}


}
