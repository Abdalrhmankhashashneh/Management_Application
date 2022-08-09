<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\activities;
use App\Models\request;
use App\Models\vacation;
use App\Models\offdayuser;
use Validator;
use App\Models\leavetype as Leavetypes;


use Hash;
use Session;
use DateTime;

use Illuminate\Http\Request as req;

class UserControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $activities = activities::join('leavetypes', 'leavetypes.id', '=', 'activities.leave_id')
            ->join('users', 'users.id', '=', 'activities.user_id')
            ->select('activities.*', 'leavetypes.name as leave_name', 'users.name as user_name')
            ->orderBy('activities.id', 'desc')->where('user_id', Session::get('user_id'))
            ->get();

            $now = new DateTime();
            $leavetypes=leavetypes::all();
            $user = User::where('id', Session::get('user_id'))->first();

            return view('index', compact('user' , 'activities' , 'leavetypes'));
    }

    public function start_end_clock(req $request)
    {
        if(Session::has('clock'))
        {
            activities::create([
                'user_id' => Session::get('user_id'),
                'leave_id' => Session::get('leave_id'),
                'start' => Session::get('clock'),
                'end' => date('H:i:s'),
                'date' => date('Y-m-d'),
            ]);
            Session::forget('clock');
            Session::forget('leave_id');
        }
        else
        {
            Session::put('clock', date('H:i:s'));
            Session::put('leave_id', $request->leave_id);
        }
        return redirect()->back();
    }


}
