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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function index()
    {
        return view('frontend.login');
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

        $user = User::where('email',$request->email)->where('decrypted_password',$request->password)->where('role',3)->where('estatus',1)->first();
        if ($user) {
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
            $cart_data = json_decode($cookie_data, true);
            if($cart_data){  
                foreach($cart_data as $cart){
                    $cart_data = ItemCart::where(['user_id' => session('customer.id'),'item_id' => $cart['item_id'],'item_type' => $cart['item_type'] ])->first();
                    if(!$cart_data){
                        ItemCart::create([
                            'user_id' => $user_id,
                            'item_id' => $cart['item_id'],
                            'item_type' => $cart['item_type'],
                            'item_quantity' => $cart['item_quantity'],
                            'specification' => (isset($cart['specification']))?json_encode($cart['specification']) :""
                        ]);
                    }
                }
            }
            Cookie::queue(Cookie::forget('shopping_cart'));

            return response()->json(['status'=>200]);
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
        return view('frontend.register');
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

        return response()->json(['status'=>200]);

    }
}
