<?php

namespace App\Http\Controllers\Forum;

use App\Models\Blogs;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

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
        session()->flash('success', 'さらなる成功を！');
        return redirect()->route('blog');
    }


//     public function editBlog(Request $request)
// {
//     $blog_creator_id = DB::table('blogs')->pluck('creator_id');
//     $blog = Blogs::where('creator_id', Auth::user()->id)->get();
//     // $current_Creator = Creators::where('email', Auth::user()->email)->first();

//     if($blog_creator_id == Auth::user()->id ){
//         if ($request->hasFile('file')) {
//             // Nếu có file ảnh được tải lên, thực hiện cập nhật ảnh
//             $file = $request->file;
//             $fileName = $file->getClientOriginalName();
//             $file->move('public/uploads', $file->getClientOriginalName());
//             $thumbnail = $fileName;
    
//             $blog->image = $thumbnail;
//         }
    
//         // Cập nhật các trường thông tin khác không liên quan đến ảnh
//         $blog->title = $request->tile;
//         $blog->save();
//     }

//     session()->flash('Success', 'Cập nhật thành công');
//     return redirect()->back();
// }

}
