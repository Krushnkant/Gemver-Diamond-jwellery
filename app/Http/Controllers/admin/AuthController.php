<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    private $page = "Gemver Admin";

    public function index()
    {
        return view('admin.auth.login')->with('page',$this->page);
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
        $user = User::where('email',$request->email)->where('decrypted_password',$request->password)->whereNotIn('role',['3'])->first();
        if ($user) {
        if($user->estatus == 1){    
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
    //            dd(Auth::user()->toArray());
                return response()->json(['status'=>200]);
                /*return redirect()->intended('admin/dashboard')
                    ->withSuccess('You have Successfully loggedin');*/
            }
        }else{
            return response()->json(['status'=>300]);
        }    
        }
        return response()->json(['status'=>400]);
//        return redirect("admin")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /*public function dashboard()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }

        return redirect("admin")->withSuccess('Opps! You do not have access');
    }*/

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('admin');
    }
}
