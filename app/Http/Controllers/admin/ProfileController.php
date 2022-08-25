<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    private $page = "Profile";

    public function profile()
    {
        $user = User::where('id',Auth::user()->id)->where('estatus',1)->first();
        //dd($user);
        return view('admin.profile.view',compact('user'))->with('page',$this->page);
    }

    public function edit($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request){
        $messages = [
            'profile_pic.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'profile_pic.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'full_name.required' =>'Please provide a Full Name',
            'mobile_no.required' =>'Please provide a Mobile No.',
            'dob.required' =>'Please provide a Date of Birth.',
            'email.required' =>'Please provide a valid E-mail address.',
            'password.required' =>'Please provide a Password.',
        ];

        $validator = Validator::make($request->all(), [
            'profile_pic' => 'image|mimes:jpeg,png,jpg',
            'full_name' => 'required',
            'mobile_no' => 'required|numeric|digits:10',
            'dob' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $user = User::find($request->user_id);

        if(!$user){
            return response()->json(['status' => '400']);
        }

        $old_image = $user->profile_pic;
        $image_name = $old_image;

        $user->full_name = $request->full_name;
        $user->mobile_no = $request->mobile_no;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->decrypted_password = $request->password;

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $image_name = 'profilePic_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/profile_pic');
            $image->move($destinationPath, $image_name);
            if(isset($old_image)) {
                $old_image = public_path('images/profile_pic/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $user->profile_pic = $image_name;
        }

        $user->save();

        return response()->json(['status' => '200','user'=>$user]);
    }
}
