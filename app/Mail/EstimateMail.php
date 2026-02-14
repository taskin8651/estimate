<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
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

        return $this->from(
                config('mail.from.address'),
                $setting->company_name ?? config('app.name')
            )
            ->replyTo($setting->company_email)
            ->subject(
                'Estimate #' . $this->estimate->estimate_number .
                ' from ' . ($setting->company_name ?? config('app.name'))
            )
            ->view('emails.estimate')
            ->with([
                'estimate' => $this->estimate,
                'setting'  => $setting
            ]);
    }
}
