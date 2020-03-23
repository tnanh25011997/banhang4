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
        $output = "<option value> Chọn Quận/Huyện</option>";
        foreach ($district as $dt) {
        	$output.= "<option value='".sprintf('%03d', $dt->id)."'>".$dt->name."</option>";
        }
        echo $output;
       
    }
    public function getWard($district_id)
    {
    	
        $ward = Ward::where('district_id',$district_id)->get();
        $output = "<option value> Chọn Xã/Phường</option>";
        foreach ($ward as $wa) {
        	$output.= "<option value='".sprintf('%05d', $wa->id)."'>".$wa->name."</option>";
        }
        echo $output;
       
    }
}
