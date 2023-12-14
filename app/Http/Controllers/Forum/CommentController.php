<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Blogs;

class CommentController extends Controller
{
    public function addComment(Request $request) {

        $user_id = Auth::user()->id;
        $result = Blogs::paginate(10);

        $data = [
            'user_id' => $user_id,
            'blog_id' => $request->blog_id,
            'content' => $request->content
        ];

        if ($comment = Comments::create($data)) {
            $comments = Comments::where(['blog_id' => $request->blog_id, 'reply_id' => 0])->orderBy('id','DESC')->get();
            return view('forum.index', compact('comments', 'result'));
        } 

        return response()->json(['error' => 'Comment has not been posted']);

    }
}
