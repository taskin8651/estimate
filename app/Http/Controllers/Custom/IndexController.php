<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\HeroSection;
use App\Models\PricingPlan;
use App\Models\Testimonial;
use App\Models\Brand;
use App\Models\Gallery;

class IndexController extends Controller
{
   public function index()
{
    $services = Service::where('status', 1)->latest()->get();
    $heroes = HeroSection::latest()->get();
    $plans = PricingPlan::orderBy('order')->get();
    $testimonials = Testimonial::latest()->get();
    $brands = Brand::latest()->get();

    // ✅ Gallery add
    $galleries = Gallery::where('status', 1)->latest()->get();

    return view('custom.index', compact(
        'services',
        'heroes',
        'plans',
        'testimonials',
        'brands',
        'galleries'
    ));
}
}