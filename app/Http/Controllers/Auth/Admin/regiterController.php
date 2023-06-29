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
        $existingUser = User::where('email', $request->email)->first();
        $data = $request->only('email','name','password');
        $password_h = bcrypt($request->password);
        $data['password'] = $password_h;
        $data['token'] = $token;
        $data['type'] = 'creator';
        $users = User::all();
        if($existingUser != null){
            return redirect()->back()->with('error', 'このメールは既に存在します');
        }else if($customer = User::create($data)){
            Mail::send('auth.emails.active',compact('customer'),function($email) use($customer){
                $email->subject('Adward Japan');
                $email->to($customer->email, $customer->name);
            });
            return redirect()->route('creator.login')->with('success','サインアップの成功');
        }
    }
    public function actived( $customerID, $token){  
        $customer = User::where('id',$customerID)->first();
        if($customer->token === $token){
            $customer->update(['status' => 1, 'token' => null]);
            return redirect()->route('creator.login')->with('success','メール確認が成功しました');
        }else{
            return redirect()->route('creator.login')->with('error','送信した確認コードが一致しません');
        }
    }
}
