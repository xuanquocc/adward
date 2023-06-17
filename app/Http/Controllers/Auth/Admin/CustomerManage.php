<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use App\Models\Customers;
use App\Models\Events;
use App\Models\Projects;
use App\Models\Task;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class CustomerManage extends Controller
{
    public function index()
    {
        $result = DB::table('customers')->paginate(10);
        return view('auth.clientManage.index', [
            'result' => $result,
        ]);
    }

    public function addCustomerScreen()
    {
        return view('auth.clientManage.addClient');
    }

    public function addProjectScreen()
    {
        $customers = DB::table('customers')->get();
        return view('auth.clientManage.addProject', [
            'customers' => $customers,
        ]);
    }

    public function addProject(Request $request)
    {
        $getNameCustomer = DB::table('customers')->where('id', $request->customer)->get();

        if ($request->validate([
            'name' => 'required',
            'customer' => 'required',
            'deadline' => 'required',
            'start' => 'required',
        ])) {
            DB::table('projects')->insert(
                [
                    'name' => $request->name,
                    'customer' => $getNameCustomer[0]->name,
                    'deadline' => $request->deadline,
                    'start' => $request->start,
                    'customers_id' => $request->customer,
                ]
            );
            session()->flash('success', 'Thêm thành công!');
            return redirect()->route('admin.customer');
        } else {
            session()->flash('error', 'Yêu cầu nhập đầy đủ thông tin');
            return redirect()->back();
        }
    }

    public function showProject($id){
        $projects = Projects::where('customers_id',$id)->get();
      
        return view('auth.clientManage.project',['projects' => $projects, 'customer_id' => $id]);
    }

    public function assignScreen($id){
        $projects =Tasks::where('project_id',$id)->get();
        $projects_id =Projects::where('id',$id)->first();
        $creators = Creators::paginate(2);
        $creatorAssign = $projects->pluck('creator_id');
        $creator = Creators::select('*')->whereNotIn('main_id',$creatorAssign)->paginate(2);
        if(!($projects == [''])){
            // dd($creator[0]);
            return view('auth.clientManage.assignScreen',['creator' => $creator, 'projectId' => $projects_id->id]);
        }
        else{
            
            return view('auth.clientManage.assignScreen',['creator' => $creators,'projectId' => $projects_id->id]);
        }
    }
    public function assign( $project_id, $creator_id){
        DB::table('tasks')->insert([
            'project_id' => $project_id,
            'creator_id' => $creator_id
        ]);
        session()->flash('success', 'Assign thành công!');
        return redirect()->back();
        // dd($project_id,$creator_id);
    }

    public function showTotalCreator($project_id){
        $project_ids = Tasks::where('project_id',$project_id)->pluck('creator_id')->toArray();
        $project_name = Projects::where('id',$project_id)->pluck('name')->first();
        $creators_info = Creators::whereIn('main_id', $project_ids)->get();
        $creators_info->each(function ($creator) use ($project_id) {
            $total_hours_creator = Events::where('project_id', $project_id)->where('creator_id',$creator->main_id)->sum('hours');
            $total_hours = Events::where('project_id', $project_id)->sum('hours');
            $creator->total_hours_creator = $total_hours_creator;
            $creator->total_hours = $total_hours;
        });
        // dd($creators_info);
        return view('auth.clientManage.projectDetail',['creators_info' => $creators_info, 'projectId'=>$project_id, 'projectName' => $project_name]);
    }
}
