<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatorManage extends Controller
{
    public function index()
    {
        $creator = User::where('id', Auth::user()->id)->first();
        $creator_detail = Creators::where('main_id', Auth::user()->id)->first();
        return view('creator.index', ['creator' => $creator, 'creatorDetail' => $creator_detail]);
    }

    public function editProfile(Request $request)
    {
        if ($request->hasFile('file')) {
            $user = User::where('id', Auth::user()->id)->get();
            $current_Creator = Creators::where('email', Auth::user()->email)->first();
            $file = $request->file;
            $fileName = $file->getClientOriginalName();

            $file->move('public/uploads', $file->getClientOriginalName());
            $thumbnail = $fileName;
            // $input['thumbnail'] = $thumbnail;
            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'thumbnail' => $thumbnail,
            ]);

            if (Auth::user()->email == $current_Creator->email) {
                Creators::where('main_id',Auth::user()->id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'experience' => $request->experience,
                    'major' => $request->major,
                    'thumbnail' => $thumbnail,
                ]);
            }

            session()->flash('Success', 'Cập nhật thành công');
        }
        return redirect()->back();
        // $current_Creator = Creators::where('email',Auth::user()->email)->first();
        // dd($current_Creator->email);
    }
}
