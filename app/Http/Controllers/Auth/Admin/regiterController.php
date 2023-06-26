<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Str;
use Mail;

class regiterController extends Controller
{
    public function check_register(Request $request){
        $request->validate([
            'email' => 'unique:users|required',
            'password' => 'required|min:8',
            'name' => 'required',
            'passwordConfirm' => 'required|same:password'
        ]);
        $token = strtoupper(Str::random(10));
        $data = $request->only('email','name','password');
        $password_h = bcrypt($request->password);
        $data['password'] = $password_h;
        $data['token'] = $token;
        $data['type'] = 'creator';

        if($customer = User::create($data)){
            Mail::send('auth.emails.active',compact('customer'),function($email) use($customer){
                $email->subject('Adward Japan');
                $email->to($customer->email, $customer->name);
            });
            return redirect()->route('creator.login')->with('success','đăng ký thành công');
        }

        return redirect()->back();
    }
    public function actived( $customerID, $token){  
        $customer = User::where('id',$customerID)->first();
        if($customer->token === $token){
            $customer->update(['status' => 1, 'token' => null]);
            return redirect()->route('creator.login')->with('success','Xác nhận email thành công');
        }else{
            return redirect()->route('creator.login')->with('error','Mã xác nhận bạn gửi không khớp ');
        }
    }
}
