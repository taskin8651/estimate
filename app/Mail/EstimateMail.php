<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;

class EstimateMail extends Mailable
{
    use SerializesModels;

    public $estimate;

    public function __construct($estimate)
    {
        $this->estimate = $estimate;
    }

    public function build()
    {
        $setting = Setting::first();

        $pdf = Pdf::loadView('admin.estimates.pdf', [
            'estimate' => $this->estimate,
            'setting' => $setting
        ]);

        return $this->subject('Estimate '.$this->estimate->estimate_number)
            ->view('emails.estimate')
            ->with([
                'estimate' => $this->estimate,
                'setting' => $setting
            ])
            ->attachData(
                $pdf->output(),
                'Estimate-'.$this->estimate->estimate_number.'.pdf'
            );
    }
}
