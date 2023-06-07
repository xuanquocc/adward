<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use App\Models\Customers;
use App\Models\Projects;
use App\Models\Task;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $projects = Customers::find($id)->projects;
        
        return view('auth.clientManage.project',['projects' => $projects]);
    }

    public function assignScreen(Request $request ,$id){
        $projects =Tasks::where('project_id',$id)->get();
        $creators = Creators::all();
        $creatorAssign = $projects->pluck('creator_id');
        $creator = User::select('*')->whereNotIn('id',$creatorAssign)->where('type','creator');
        if($projects == null){
            return view('auth.clientManage.assignScreen',['creators' => $creators]);
        }else{

            return view('auth.clientManage.assignScreen',['creator' => $creator]);
        }
    }
    public function showProjectDetail($id){
        $creators = Projects::find($id)->creators;
        return view('auth.clientManage.projectDetail',['creators' => $creators]);
    }
}
