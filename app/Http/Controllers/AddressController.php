<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function address(){
        $address = Address::where('user_id',session('customer.id'))->get();
        $meta_title = "User Address";
        $meta_description = "User Address";
        return  view('frontend.myaccount_address',compact('address'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function addresssave(Request $request){
        //dd($request->all());

        if($request->check_address == 'new'){
        $messages = [
            'first_name.required' =>'Please provide a First Name ',
            'last_name.required' =>'Please provide a Last Name',
            'email.required' =>'Please provide a Email',
            'mobile_no.required' =>'Please provide a Mobile No',
            'address.required' =>'Please provide a Address',
            'city.required' =>'Please provide a City',
            'state.required' =>'Please provide a State',
            'country.required' =>'Please provide a Country',
            'pincode.required' =>'Please provide a Pincode'
        ];
        
        $validator = Validator::make($request->all(), [
            'first_name' =>'required',
            'last_name' =>'required',
            'email' =>'required|email',
            'mobile_no' =>'required',
            'address' =>'required',
            'city' =>'required',
            'state' =>'required',
            'country' =>'required',
            'pincode' =>'required'
        ], $messages);
       }else{

        $messages = [
            'new_address.required' =>'Please select address',
        ];
        
        $validator = Validator::make($request->all(), [
            'new_address' =>'required',
      
        ], $messages);

       }
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

    
        $address = new Address();
        $address->user_id = $request->user_id;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->mobile_no = $request->mobile_no;
        $address->address = $request->address;
        $address->address2 = $request->address2;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->pincode = $request->pincode;
        $address->save();
        return response()->json(['status' => '200','address' => $address]);
    }

    public function editaddress($id){
        $address = Address::find($id);
        return response()->json($address);
    }

    public function deleteaddress($id){
        $address = Address::find($id);
        if ($address){
            $address->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function updateAddress(Request $request){
    
        $messages = [
            'first_name.required' =>'Please provide a First Name',
            'last_name.required' =>'Please provide a Last Name',
            'email.required' =>'Please provide a Email',
            'mobile_no.required' =>'Please provide a Mobile No',
            'address.required' =>'Please provide a Address',
            'country.required' =>'Please provide a Country',
            'state.required' =>'Please provide a State',
            'city.required' =>'Please provide a City',
            'pincode.required' =>'Please provide a Pincode',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $address = Address::find($request->address_id);
        if ($address) {
            $address->first_name = $request->first_name;
            $address->last_name = $request->last_name;
            $address->email = $request->email;
            $address->mobile_no = $request->mobile_no;
            $address->address = $request->address;
            $address->address2 = $request->address2;
            $address->state = $request->state;
            $address->city = $request->city;
            $address->pincode = $request->pincode;
            $address->country = $request->country;
            $address->save();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);

        }
    
}
