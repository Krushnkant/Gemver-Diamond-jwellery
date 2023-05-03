<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\ItemCart;
use App\Models\Settings;
use App\Http\Helpers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Redirect;


class AuthController extends Controller
{

    public function index()
    {
        $meta_title = "User Login";
        $meta_description = "User Login";
        return view('frontend.login')->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function invalid_page()
    {
        return view('admin.403_page');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $user = User::where('email',$request->email)->where('decrypted_password',$request->password)->where('role',3)->first();
        if ($user) {
            if($user->estatus == 1){
                $data = array(
                    'id' => $user->id,
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'mobile_no' => $user->mobile_no,
                    'profile_pic' => $user->profile_pic
                );
                $request->session()->put('customer',$data);
                $user_id = session('customer.id');

                $cookie_data = stripslashes(Cookie::get('product_wishlist'));
                $wishlist_data = json_decode($cookie_data, true);
                if($wishlist_data){  
                    foreach($wishlist_data as $wishlist){
                        $wishlist_data = Wishlist::where(['user_id' => session('customer.id'),'item_id' => $wishlist['item_id'],'item_type' => $wishlist['item_type'] ])->first();
                        if(!$wishlist_data){
                            Wishlist::create([
                                'user_id' => $user_id,
                                'item_id' => $wishlist['item_id'],
                                'item_type' => $wishlist['item_type']
                            ]);
                        }
                    }
                }
                Cookie::queue(Cookie::forget('product_wishlist'));

                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_datas = json_decode($cookie_data, true);
        
                if($cart_datas){  
                    foreach($cart_datas as $cart){
                        
                        $cart_data = ItemCart::where(['user_id' => session('customer.id'),'item_id' => $cart['item_id'],'item_type' => $cart['item_type'] ])->first();
                        //dd($cart);
                        if(!$cart_data){
                        //    $cart = ItemCart::create([
                        //         'user_id' => $user_id,
                        //         'diamond_id' => 50,
                        //         'item_quantity' => $cart['item_quantity'],
                        //         'item_id' => $cart['item_id'],
                        //         'item_type' => $cart['item_type'],
                        //         'specification' => (isset($cart['specification']))?json_encode($cart['specification']) :""
                        //     ]);
                        $cartitem = New ItemCart();
                        $cartitem->user_id = $user_id;
                        $cartitem->diamond_id = $cart['diamond_id'];
                        $cartitem->item_quantity = $cart['item_quantity'];
                        $cartitem->item_id = $cart['item_id'];
                        $cartitem->item_type = $cart['item_type'];
                        $cartitem->specification = (isset($cart['specification']))?json_encode($cart['specification']) :"";
                        $cartitem->save();
                      
                        }
                    }
                    Cookie::queue(Cookie::forget('shopping_cart'));
                }
            
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>300]);
            }
        }
        
        return response()->json(['status'=>400]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('admin');
    }


    public function register()
    {
        $meta_title = "User Sign Up";
        $meta_description = "User Sign Up";
        return view('frontend.register')->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $user = new User();
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->decrypted_password = $request->password;
        $user->role = 3;
        $user->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
        $user->save();

        $data = array(
            'id' => $user->id,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'mobile_no' => $user->mobile_no,
            'profile_pic' => $user->profile_pic
        );
        $request->session()->put('customer',$data);
        $user_id = session('customer.id');

        $cookie_data = stripslashes(Cookie::get('product_wishlist'));
        $wishlist_data = json_decode($cookie_data, true);
        if($wishlist_data){  
            foreach($wishlist_data as $wishlist){
                $wishlist_data = Wishlist::where(['user_id' => session('customer.id'),'item_id' => $wishlist['item_id'],'item_type' => $wishlist['item_type'] ])->first();
                if(!$wishlist_data){
                    Wishlist::create([
                        'user_id' => $user_id,
                        'item_id' => $wishlist['item_id'],
                        'item_type' => $wishlist['item_type']
                    ]);
                }
            }
        }
        Cookie::queue(Cookie::forget('product_wishlist'));

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_datas = json_decode($cookie_data, true);

        if($cart_datas){  
            foreach($cart_datas as $cart){
                
                $cart_data = ItemCart::where(['user_id' => session('customer.id'),'item_id' => $cart['item_id'],'item_type' => $cart['item_type'] ])->first();
                //dd($cart);
                if(!$cart_data){
                //    $cart = ItemCart::create([
                //         'user_id' => $user_id,
                //         'diamond_id' => 50,
                //         'item_quantity' => $cart['item_quantity'],
                //         'item_id' => $cart['item_id'],
                //         'item_type' => $cart['item_type'],
                //         'specification' => (isset($cart['specification']))?json_encode($cart['specification']) :""
                //     ]);
                $cartitem = New ItemCart();
                $cartitem->user_id = $user_id;
                $cartitem->diamond_id = $cart['diamond_id'];
                $cartitem->item_quantity = $cart['item_quantity'];
                $cartitem->item_id = $cart['item_id'];
                $cartitem->item_type = $cart['item_type'];
                $cartitem->specification = (isset($cart['specification']))?json_encode($cart['specification']) :"";
                $cartitem->save();
              
                }
            }
            Cookie::queue(Cookie::forget('shopping_cart'));
        }

        $data2 = [
            'message1' => 'Thank you for joining Gemver Affordable Luxury'
        ]; 
        $templateName = 'email.mailDataregister';
        $subject = 'Welcome Gemver Affordable Luxury';
        $mail_sending = Helpers::MailSending($templateName, $data2, $request->email, $subject);

        return response()->json(['status'=>200]);

    }

    public function forgetpassword()
    {
        $meta_title = "User Forget Password";
        $meta_description = "User Forget Password";
        return view('frontend.forget_password')->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function postForgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $user = User::where('email',$request->email)->where('role',3)->where('estatus',1)->first();
        if ($user){
            $string = str_random(15);
            $user = User::where('email',$request->email)->first();
            $user->forget_token = $string;
            $user->save();

            $data2 = [
                //'message1' => 'https://gemver.matoresell.com/public/resetpassword/'.$string
                'message1' => url('resetpassword/'.$string)
            ]; 
            $templateName = 'email.mailDataforgetpassword';
            $subject = 'Forget Password';
            $mail_sending = Helpers::MailSending($templateName, $data2, $request->email, $subject);

            return response()->json(['status'=>200]); 
        }    
        return response()->json(['status'=>400]);
    }

    public function resetpassword($key)
    {
        $user = User::where('forget_token',$key)->first();
        if($user){
            return view('frontend.resetpassword',compact('user'));
        }else{
            return Redirect::to('/forget-password');
        }
        
    }

    public function postResetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|same:confirm_password'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $user = User::where('id',$request->user_id)->where('role',3)->where('estatus',1)->first();
        if ($user){
           
            $user = User::where('id',$request->user_id)->first();
            $user->forget_token = "";
            $user->password = Hash::make($request->password);
            $user->decrypted_password = $request->password;
            $user->save();

            return response()->json(['status'=>200]); 
        }    
        return response()->json(['status'=>400]);
    }


    public function account(){
        $user = user::where('id',session('customer.id'))->first();
        $meta_title = "User Account";
        $meta_description = "User Account";
        return  view('frontend.myaccount',compact('user'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function updateProfile(Request $request){
       
        $messages = [
            'name.required' =>'Please provide a  Name',
            'email.required' =>'Please provide a Email',
            'mobile_no.required' =>'Please provide a Mobile No'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $user = User::find(session('customer.id'));
        if ($user) {
            $user->full_name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->save();
            return response()->json(['status' => '200','data' => $user]);
        }
        return response()->json(['status' => '400']);

    }

    public function messagebox(){
        $user = user::where('id',session('customer.id'))->first();
        $meta_title = "User Message Box";
        $meta_description = "User Message Box";
        return  view('frontend.message-box',compact('user'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function updatePassword(Request $request){
       
        $messages = [
            'current_password.required' =>'Please provide a  Current Password',
            'new_password.required' =>'Please provide a New Password',
            'confirm_password.required' =>'Please provide a Confirm Password'
        ];
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $user = User::where('decrypted_password',$request->current_password)->where('id',session('customer.id'))->first();
        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->decrypted_password = $request->new_password;
            $user->save();
            return response()->json(['status' => '200','data' => $user]);
        }else{
            return response()->json(['status' => '600']);
        }
        return response()->json(['status' => '400']);

    }


}
