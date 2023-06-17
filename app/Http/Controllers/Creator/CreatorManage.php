<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatorManage extends Controller
{
    public function index()
    {
        $creator = User::where('id', Auth::user()->id)->first();
        $creator_detail = Creators::where('main_id', Auth::user()->id)->first();
        $project_assiged = Tasks::where('creator_id', Auth::user()->id)->pluck('project_id');
        $project_name = Projects::whereIn('id', $project_assiged)->get();
        return view('creator.index', ['creator' => $creator, 'creatorDetail' => $creator_detail, 'projectName' => $project_name]);
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
                Creators::where('main_id', Auth::user()->id)->update([
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
    }

    public function getEvent($id, $creator_id)
    {
        // dd($creator_id);
        $events = array();
        $auth_current = Auth::user()->id;
        $workings = Events::where('project_id', $id)->where('creator_id',$auth_current)->get();
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
        return view('creator.fullcalendar', ['event' => $events, 'projectId' => $id, 'creatorId' => $creator_id,'currenUserId' => $auth_current]);

    }

    public function getEvents($creatorId)
{
    // Truy vấn và trả về dữ liệu sự kiện dựa trên $creatorId
    $events = Events::where('creator_id', $creatorId)->get();
    return response()->json(['events' => $events]);
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'hours' => 'required|numeric',
        ]);

        $booking = Events::create([
            'title' => $request->title,
            'hours' => $request->hours,
            'project_id' => $request->project_id,
            'creator_id' => $request->creator_id,
            'start' => $request->start_date,
            'end' => $request->end_date,
        ]);

        // $color = null;

        // if($booking->title == 'Test') {
        //     $color = '#924ACE';
        // }

        return response()->json($booking);
    }

    public function update(Request $request, $id)
    {
        $booking = Events::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event',
            ], 404);
        }
        $booking->update([
            'start' => $request->start_date,
            'end' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }
    public function destroy($id)
    {
        $booking = Events::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event',
            ], 404);
        }
        $booking->delete();
        return $id;
    }

    public function search(Request $request, $projectId)
    {
        $date = $request->input('date');

       $event_search = Events::where("project_id",$projectId)->whereDate("start",$date)->first();

        // $events = array();
        $events[] = [
                'id' => $event_search->id,
                'title' => $event_search->title,
                'hours' => $event_search->hours,
                'start' => $event_search->start,
                'creator_id' => $event_search->creator_id,
                'project_id' =>  $event_search->project_id,
                'end' => $event_search->end,
        ];
        return response()->json(['events' => $events]);
    }
}
