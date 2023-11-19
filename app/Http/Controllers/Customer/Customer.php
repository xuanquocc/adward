<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use App\Models\Customers;
use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Customer extends Controller
{
    public function ProjectManage()
    {
        $customer_email = User::where('id', Auth::user()->id)->pluck('email')->first();
        $id_check = Customers::where('email', $customer_email)->pluck('id')->first();
        $projects = Projects::where('customers_id', $id_check)->get();
        $projects->each(function ($project) {
            $total_hours = Events::where('project_id', $project->id)->sum('hours');
            $project->total_hours = $total_hours;
        });
        return view('customer.index', ['project' => $projects]);
    }

    public function projectShow($project_id)
    {
        $creator_id = Tasks::where('project_id', $project_id)->pluck('creator_id')->toArray();
        $project_name = Projects::where('id', $project_id)->pluck('name')->first();
        $creators_info = Creators::whereIn('main_id', $creator_id)->get();
        $creators_info->each(function ($creator) use ($project_id) {
            $total_hours_creator = Events::where('project_id', $project_id)->where('creator_id', $creator->main_id)->sum('hours');
            $total_hours = Events::where('project_id', $project_id)->sum('hours');
            $creator->total_hours_creator = $total_hours_creator;
            $creator->total_hours = $total_hours;
        });
        return view('customer.CreatorAssign', ['projectName' => $project_name, 'projectId' => $project_id, 'creatorsInfo' => $creators_info]);
    }


    public function search(Request $request, $project_id)
    {
       if($request->date != null){
        $input_date = $request->date;
        $formattedDate = Carbon::parse($input_date)->format('d/m/Y'); 

        $creator_id = Tasks::where('project_id', $project_id)->pluck('creator_id')->toArray();
        $project_name = Projects::where('id', $project_id)->pluck('name')->first();
        $project_start = Projects::where('id', $project_id)->pluck('start')->first();
        $project_startTime = Carbon::parse($project_start)->format('d/m/Y'); 
        $creators_info = Creators::whereIn('main_id', $creator_id)->paginate(3);
        $creators_info->each(function ($creator) use ($project_id, $input_date) {
            $total_creator_hours = Events::where('start', '<=', $input_date)
                ->where('project_id', $project_id)
                ->where('creator_id', $creator->main_id)
                ->sum('hours');
            $total_hours = Events::where('start', '<=', $input_date)
                ->where('project_id', $project_id)
                ->sum('hours');
            $creator->total_hours_creator = $total_creator_hours;
            $creator->total_hours = $total_hours;
        });

        // dd($creators_info);

        return view('customer.search', [
            'creators_info' => $creators_info,
            'project_id' => $project_id,
            'project_name' => $project_name,
            'input_date' => $formattedDate,
            'start' => $project_startTime,
        ])->with('success',"Search was successful!");
       }else{
        return back()->with('error', 'Search failed. Please try again.');
       }
    }

    public function getEventCustomer($id, $creator_id)
    {
        $events = array();
        $creator_name = Creators::where('main_id',$creator_id)->pluck('name')->first();
        $workings = Events::where('project_id', $id)->where('creator_id',$creator_id)->get();
        foreach ($workings as $working) {

            $events[] = [
                'id' => $working->id,
                'title' => $working->title,
                'hours' => $working->hours,
                'start' => $working->start,
                'project_id ' => $id,
                'creator_id ' => $working->creator_id,
                'end' => $working->end,
            ];
        }

        return view('customer.creatorDetail', ['event' => $events, 'projectId' => $id, 'creatorId' => $creator_id, 'creatorName' => $creator_name]);

    }
}