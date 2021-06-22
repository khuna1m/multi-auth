<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\SubDistrict;

class AddressController extends Controller
{
    public function showForm()
    {
        return view('form');
    }
    public function getProvince()
    {
        $allProvince = Province::all();
        // dd($allProvince);
        return response()->json(['provinces' => $allProvince], 200);
    }
    public function getDistrict(Request $request)
    {
        $allDistrict = District::where('province_id', '=', $request->id)->get();
        // dd($request->id);
        return response()->json(['districts' => $allDistrict], 200);
    }
    public function getSubDistrict(Request $request)
    {
        $allSubDistrict = SubDistrict::where('district_id', '=', $request->id)->get();
        // dd($request->id);
        return response()->json(['subdistricts' => $allSubDistrict], 200);
    }
}