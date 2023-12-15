<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Creators;
use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\Support\Facades\DB;
class AdminCreatorManage extends Controller
{
    public function index()
    {
        $creators = Creators::paginate(2);
        return view('auth.creatorManage.index', ['creators' => $creators]);
    }

    // public function calculateProjectTotalHours($project_id)
    // {
    //     $total_hours = Events::where('project_id', $project_id)->sum('hours');
    //     return $total_hours;
    // }

    public function showProject($creator_id)
    {
        $project_ids = Tasks::where('creator_id', $creator_id)->pluck('project_id')->toArray();
        $project_info = Projects::whereIn('id', $project_ids)->get();
        $project_info->each(function ($project) use ($creator_id) {
            $total_hours = Events::where('project_id', $project->id)->where('creator_id',$creator_id)->sum('hours');
            $project->total_hours = $total_hours;
            $project->creator_id = $creator_id;
        });
        return $project_info;
    }

    public function accecptBlog($blog_id){
        $blog = Blogs::where('id',$blog_id)->first();
        $blog->status = 1;

        $blog->save();
        return redirect()->back()->with('success','ステータスが正常に更新されました');
    }
    public function rejectBlog($blog_id){
        DB::table('blogs')->where('id',$blog_id)->delete();
        return redirect()->back()->with('success','ブログが正常に削除されました');
    }

   
}
