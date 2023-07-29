<?php

namespace App\Http\Controllers\Api;

use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;

class LocationController extends Controller
{
    public function provinces(Request $request)
    {
        return Province::OrderBy('name', 'ASC')->get();
    }

    public function regencies(Request $request, $provinces_id)
    {
        return Regency::where('province_id', $provinces_id)->OrderBy('name', 'ASC')->get();
    }

    public function district(Request $request, $regencys_id)
    {
        //return $regencys_id;
        return District::where('regency_id', $regencys_id)->OrderBy('name', 'ASC')->get();
    }
}
