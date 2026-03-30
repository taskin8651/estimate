<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
use App\Models\Setting;


class DemoestimateController extends Controller
{
    public function index()
{
   

    return view('demo-estimate');
}
}