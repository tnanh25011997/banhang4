<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\District;
use App\Ward;


class AddressController extends Controller
{
    public function getDistrict($province_id)
    {
    	
        $district = District::where('province_id',$province_id)->get();
        foreach ($district as $dt) {
        	echo "<option value='".$dt->id."'>".$dt->name."</option>";
        }
       
    }
    public function getWard($district_id)
    {
    	
        $ward = Ward::where('district_id',$district_id)->get();
        foreach ($ward as $wa) {
        	echo "<option value='".$wa->id."'>".$wa->name."</option>";
        }
       
    }
}
