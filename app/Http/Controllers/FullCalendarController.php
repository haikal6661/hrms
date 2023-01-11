<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {  
            $events = LeaveApplication::with('hasStaff')->whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)
                ->get();


            $data = [];
            foreach($events as $row){
                $data[] = [
                    'title' => $row->hasStaff->fullname,
                    'start' => $row->start_date,
                    'end' => $row->end_date,
                ];
            }
            
            return response()->json(collect($data));
        }
        // return view('welcome');
    }
}
