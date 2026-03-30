<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    // ✅ Service Listing Page
    public function index()
    {
        $services = Service::where('status', 1)->latest()->get();

        return view('custom.services', compact('services'));
    }

    // ✅ Optional: Single Service Detail Page
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('custom.service-details', compact('service'));
    }
}