<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ManageBlogController extends Controller
{
    public function index(){
        $result = Blogs::paginate(10);
        return view('forum.index', [
            'result' => $result
        ]);
    }

    public function createPost(){
        return view('forum.createPost');
    }

    public function addPost(Request $request){

        // dd($request->all());
        if ($request->hasFile('file')) {
            $file = $request->file;
            $fileName = $file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $file->getSize();

            $file->move('public/uploads', $file->getClientOriginalName());
            $thumbnail = $fileName;
            // $input['thumbnail'] = $thumbnail;

            DB::table('blogs')->insert([
                'creator_id' => Auth::user()->id,
                'content' => $request->content,
                'title' => $request->title,
                'image' => $thumbnail
            ]);

            
        }else{
            DB::table('blogs')->insert([
                'creator_id' => Auth::user()->id,
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }
        session()->flash('success', 'Thêm thành công!');
        return redirect()->route('blog');
    }

}
