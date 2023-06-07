<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterCustumer extends Controller
{
    public function createClient(Request $request)
    {

        if ($request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
            'location' => 'required',
            'passwordConfirm' => 'required|min:8|same:password',
        ])) {
            DB::table('users')->insert(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'type' => 'user',
                ]
            );

            DB::table('customers')->insert(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'location' => $request->location,
                ]
            );
            session()->flash('status', 'đăng ký thành công');
            return redirect()->route('admin.customer');
        }

    }
}
