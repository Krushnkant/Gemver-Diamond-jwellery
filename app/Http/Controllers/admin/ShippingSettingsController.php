<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;

class ShippingSettingsController extends Controller
{
    public function shippingSettings(Request $request)
    {
        $shippingSettings = Settings::first();
        return view('admin.menupage.shipping',compact('shippingSettings'));
    }

    public function updateShippingSettings(Request $request)
    {
         $settingsData =  Settings::first();
         if(isset($settingsData))
         {
           $settingsData->min_order_amount_for_free_shipping = $request->min_order_amount_for_free_shipping;
           $settingsData->default_shipping_amount = $request->default_shipping_amount;
           $settingsData->update();
         }
         return response()->json(['status' => '200']);
    }
}
