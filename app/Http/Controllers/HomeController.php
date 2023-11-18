<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\Staff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get current month leaves application
        $currentMonth = date("m");
        $month = LeaveApplication::whereMonth('start_date', $currentMonth)->get();
        $totalLeave = count($month);

        //get current month staff birthday
        $birthday = Staff::selectRaw("SUBSTRING(ic_no, 3, 2) as birth_month")->get();

        $filteredBirthdays = $birthday->filter(function ($record) use ($currentMonth) {
            return $record->birth_month == $currentMonth;
        });

        $totalBirthday = $filteredBirthdays->count();

        $data = [
            'totalLeave' => $totalLeave,
            'totalBirthday' => $totalBirthday,
        ];
        
        return view('backend.layouts.dashboard')->with($data);
    }
}
