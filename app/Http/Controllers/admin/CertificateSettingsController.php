<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;

class CertificateSettingsController extends Controller
{
     public function certificateseSettings(Request $request)
    {
        $certificateseSettings = Settings::first();
        return view('admin.menupage.certificatese',compact('certificateseSettings'));
    }

    public function updateCertificateseSettings(Request $request)
    {
         $settingsData =  Settings::first();
         if(isset($settingsData))
         {
           $settingsData->carat_size = $request->carat_size;
           $settingsData->certificate_price = $request->certificate_price;
           $settingsData->certificate_description = $request->certificate_description;
           $settingsData->update();
         }
         return response()->json(['status' => '200']);
    }
}
