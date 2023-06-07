<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }


    public function checkLogin(Request $request){

        $this->validate($request, [
            'email' => 'required|Email:filter',
            'password' => 'required'
        ]);

        $type = DB::table('Users')->where('email', $request->email)->first();
        $creator = Creators::where('email',$request->email)->first();
        if (Auth::attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ],
            
        )) {

            if ($type->type == "admin") {
                return redirect()->route('admin.home');
            } else if($type->type == "user"){
                return redirect()->route('customer.home');
            }else if($type->type == "creator" ){
                 if($creator == null){
                    Creators::create([
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'main_id' => Auth::user()->id,
                    ]);
                 }
                return redirect()->route('creator.home');
            }
                dd($creator);
            // $hashed = Hash::make($request->password);
        }else {
            Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
            return redirect()->back();
        }
        
    }
    public function logout()
{
    Auth::logout();
    return redirect()->route('login.bol');
}
}
