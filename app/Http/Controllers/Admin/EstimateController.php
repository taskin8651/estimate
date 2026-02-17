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
        $clients = Client::pluck('name', 'id');
        return view('admin.estimates.create', compact('clients'));
    }

    // 📌 Store Estimate
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'issue_date' => 'required|date',
        ]);

        // 🔹 Auto Estimate Number
        $last = Estimate::latest()->first();
        $number = $last ? $last->id + 1 : 1;
        $estimateNumber = 'EST-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // 🔹 Calculate subtotal
        $subtotal = 0;
        foreach ($request->items as $item) {
            $subtotal += $item['quantity'] * $item['rate'];
        }

        $taxPercentage = $request->tax_percentage ?? 0;
        $taxAmount = ($subtotal * $taxPercentage) / 100;
        $total = $subtotal + $taxAmount;

        // 🔹 Create Estimate
        $estimate = Estimate::create([
            'estimate_number' => $estimateNumber,
            'client_id' => $request->client_id,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'subtotal' => $subtotal,
            'tax_percentage' => $taxPercentage,
            'tax_amount' => $taxAmount,
            'total' => $total,
            'status' => 'draft',
            'notes' => $request->notes,
            'created_by' => Auth::id(),
        ]);

        // 🔹 Save Items
        foreach ($request->items as $item) {
            EstimateItem::create([
                'estimate_id' => $estimate->id,
                'title' => $item['title'],
                'description' => $item['description'] ?? null,
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'amount' => $item['quantity'] * $item['rate'],
            ]);
        }

        return redirect()->route('admin.estimates.index')
            ->with('success', 'Estimate Created Successfully');
    }

    // 📌 Show
public function show(Estimate $estimate)
{
    // 🔐 Security check (estimate sirf apna hi open ho)
    if ($estimate->created_by != auth()->id()) {
        abort(403);
    }

    $estimate->load('client', 'items');

    // 🔹 User-wise setting
    $setting = Setting::where('created_by', auth()->id())->first();

    $template = 'admin.estimates.templates.' . $estimate->template;

    return view('admin.estimates.show', compact('estimate', 'setting', 'template'));
}





    // 📌 Delete
    public function destroy(Estimate $estimate)
    {
        $estimate->delete();
        return back()->with('success', 'Estimate Deleted');
    }


public function downloadPdf($id)
{
    $estimate = Estimate::with(['items','client','creator'])
                        ->findOrFail($id);

    // ✅ Get setting based on estimate creator
    $setting = Setting::where('created_by', $estimate->created_by)
                      ->first();

    // Fallback (agar setting na mile)
    if (!$setting) {
        $setting = Setting::first();
    }

    $template = $estimate->template ?? 'classic';

    $viewPath = 'admin.estimates.pdf.' . $template;

    if (!view()->exists($viewPath)) {
        $viewPath = 'admin.estimates.pdf.classic';
    }

    $pdf = Pdf::loadView($viewPath, compact('estimate','setting'))
              ->setPaper('a4', 'portrait')
              ->setOptions([
                  'isHtml5ParserEnabled' => true,
                  'isRemoteEnabled' => true,
                  'defaultFont' => 'DejaVu Sans'
              ]);

    return $pdf->download('Estimate-'.$estimate->estimate_number.'.pdf');
}



public function sendEstimate(Estimate $estimate)
{
    $estimate->load(['client','items','creator']);

    // ✅ Get setting based on estimate creator
    $setting = Setting::where('created_by', $estimate->created_by)
                      ->first();

    // fallback
    if (!$setting) {
        $setting = Setting::first();
    }

    Mail::to($estimate->client->email)
        ->send(new EstimateMail($estimate, $setting));

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
