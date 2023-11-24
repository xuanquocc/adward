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
use Mail;
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

    public function searchTable(Request $request)
    {
        $searchValue = $request->search;

        // Thực hiện tìm kiếm dựa trên giá trị searchValue và trả về kết quả
        // Ví dụ: sử dụng Eloquent để truy vấn trong cơ sở dữ liệu
        $results = Customers::where('name', 'like', '%' . $searchValue . '%')->get();
        // Trả về một view hoặc dữ liệu JSON tùy theo yêu cầu của bạn
        return response()->json($results);
    }

    public function searchProject(Request $request)
    {
        $searchValue = $request->search;

        // Thực hiện tìm kiếm dựa trên giá trị searchValue và trả về kết quả
        // Ví dụ: sử dụng Eloquent để truy vấn trong cơ sở dữ liệu
        $results = Projects::where('name', 'like', '%' . $searchValue . '%')->get();
        // Trả về một view hoặc dữ liệu JSON tùy theo yêu cầu của bạn
        return response()->json($results);
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
                    'expired' => 0,
                    'customers_id' => $request->customer,
                ]
            );
            session()->flash('success', '成功するプロジェクトを作成する');
            return redirect()->route('admin.customer');
        } else {
            session()->flash('error', '完全な情報が必要です');
            return redirect()->back();
        }
    }

    public function showProject($id)
    {
        $projects = Projects::where('customers_id', $id)->get();

        return view('auth.clientManage.project', ['projects' => $projects, 'customer_id' => $id]);
    }

    public function assignScreen($id)
    {
        $projects = Tasks::where('project_id', $id)->get();
        $projects_id = Projects::where('id', $id)->first();
        $creators = Creators::paginate(2);
        $creatorAssign = $projects->pluck('creator_id');
        $creator = Creators::select('*')->whereNotIn('main_id', $creatorAssign)->paginate(2);
        if (!($projects == [''])) {
            // dd($creator[0]);
            return view('auth.clientManage.assignScreen', ['creator' => $creator, 'projectId' => $projects_id->id]);
        } else {

            return view('auth.clientManage.assignScreen', ['creator' => $creators, 'projectId' => $projects_id->id]);
        }
    }
    public function assign($project_id, $creator_id)
    {
        $creator_email = User::where('id', $creator_id)->pluck('email')->first();
        $creator_name = User::where('id', $creator_id)->pluck('name')->first();
        $project_name = Projects::where('id', $project_id)->pluck('name')->first();

        DB::table('tasks')->insert([
            'project_id' => $project_id,
            'creator_id' => $creator_id
        ]);

        Mail::send('auth.emails.assignSucces', compact('creator_email', 'project_name', 'creator_name'), function ($email) use ($creator_email, $project_name, $creator_name) {
            $email->subject('Adward Japan');
            $email->to($creator_email)->subject($project_name)->subject($creator_name);
        });

        session()->flash('success', 'Assign thành công!');
        return redirect()->back();
    }


    public function showTotalCreator($project_id)
    {
        $project_ids = Tasks::where('project_id', $project_id)->pluck('creator_id')->toArray();
        $project_name = Projects::where('id', $project_id)->pluck('name')->first();
        $creators_info = Creators::whereIn('main_id', $project_ids)->paginate(3);
        $creators_info->each(function ($creator) use ($project_id) {
            $total_hours_creator = Events::where('project_id', $project_id)->where('creator_id', $creator->main_id)->sum('hours');
            $total_hours = Events::where('project_id', $project_id)->sum('hours');
            $creator->total_hours_creator = $total_hours_creator;
            $creator->total_hours = $total_hours;
        });
        // dd($creators_info);
        return view('auth.clientManage.projectDetail', ['creators_info' => $creators_info, 
                                                        'projectId' => $project_id, 
                                                        'projectName' => $project_name,]);
    }

    public function expiredProject($project_id)
    {
        $project = Projects::where('id', $project_id)->first();
        if ($project->expired == 1) {
            $project->expired = 0;
        } else {
            $project->expired = 1;
        }

        $project->save();

        return redirect()->back();
    }

    public function deleteCreator($project_id, $creator_id)
    {

        $events = Events::where('project_id', $project_id)->get();
        // dd($events);
        foreach ($events as $event) {
            if ($event->creator_id == $creator_id) {
                $event->delete();
            }
        }

        Tasks::where('creator_id', $creator_id)
            ->where('project_id', $project_id)
            ->first()
            ->delete();
        return redirect()->back();
    }
}
