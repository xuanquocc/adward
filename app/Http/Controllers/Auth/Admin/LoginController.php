<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mail;
use Str;
class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function loginScreenCreator(){
        return view('creator.login');
    }

    public function registerScreenCreator(){
        return view('creator.register');
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
            } 
        }else {
            Session::flash('error', 'メールアドレスまたはパスワードが正しくありませ');
            return redirect()->back();
        }
        
    }

    public function checkLoginCreator (Request $request){
        $this->validate($request, [
            'email' => 'required|Email:filter',
            'password' => 'required'
        ]);

        $type = User::where('email', $request->email)->first();
        $creator = Creators::where('email',$request->email)->first();
        if (Auth::attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ],
            
        )) {
            if(Auth::user()->status === 0){
                Auth::logout();
                return redirect()->route('creator.login')->with('error','アカウントがアクティブ化されていません');
            }else{
                if(Auth::user()->type === 'creator'){
                    if($creator == null){
                        Creators::create([
                            'name' => $type->name,
                            'email' => $type->email,
                            'main_id' => $type->id,
                        ]);
                    }
                    return redirect()->route('creator.home');
                }else if(Auth::user()->type === 'user'){
                    return redirect()->route('customer.home');
                }
            }
    }else{
        return redirect()->back()->with('error','メールアドレスまたはパスワードが正しくありませ');
    }
}
    public function logout()
{
    Auth::logout();
    return redirect()->route('login.bol');
}

public function forgetPass(){
    return view('forgetPass.forgetPass');
}

public function postForgetPass(Request $request ){  
    $this->validate($request, [
        'email' => 'required|exists:users',
    ],[
        'email.required' => 'メールアドレスまたはパスワードが正しくありません',
        'email.exists' => 'メールアドレスまたはパスワードが正しくありません',
    ]);
    $token = strtoupper(Str::random(10));
    $customer = User::where('email',$request->email)->first();
    $customer->update([
        'token' => $token,
    ]);
    Mail::send('auth.emails.checkEmailForget',compact('customer'),function($email) use($customer){
        $email->subject('Adward Japan - パスワードの取得 ');
        $email->to($customer->email, $customer->name);
    });
    return redirect()->back()->with('success',"メールを確認してパスワードを変更してください");
}

public function getPass( $customerID, $token){  
    $customer = User::where('id',$customerID)->first();
    if($customer->token === $token){
        return view('forgetPass.getPass' ,['customerId' => $customerID, 'token' => $token]);
    }
    return abort(404);
}

public function postGetPass(Request $request,$customerID, $token){
    $this->validate($request, [
        'password' => 'required',
        'password-confirm' => 'required|same:password'
    ]);
    $customer = User::where('id',$customerID)->first();
    $customer_type = $customer->type;
    // dd($customer);
    $password_h = bcrypt($request->password);
    $customer->update(['password' => $password_h, 'token' => null]);
    if($customer_type == 'creator'|| $customer_type == 'user'){
        return redirect()->route('creator.login')->with('success','パスワードの更新が成功しました');
    }else if($customer_type == 'admin'){
        return redirect()->route('login.bol')->with('success','パスワードの更新が成功しました');
    }
}
}
