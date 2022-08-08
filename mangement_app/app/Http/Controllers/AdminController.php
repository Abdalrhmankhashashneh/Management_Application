<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\User;
use App\Models\activities;
use App\Models\request;
use App\Models\vacation;

use Hash;
use Session;
use Illuminate\Http\Request as req;
use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $activities = activities::join('leavetypes', 'leavetypes.id', '=', 'activities.leave_id')
            ->join('users', 'users.id', '=', 'activities.user_id')
            ->select('activities.*', 'leavetypes.name as leave_name', 'users.name as user_name')
            ->orderBy('activities.id', 'desc')
            ->get();

        $admin = admin::where('id', Session::get('admin_id'))->first();
        return view('index', compact('users' , 'activities' , 'admin'));
    }


    public function vacation_request()
    {
        if(Session::has('admin_id')){
        $requests = request::join('users', 'users.id', '=', 'requests.user_id')
        ->join( 'vacations', 'vacations.id', '=', 'requests.vacation_id')
            ->select('requests.*', 'users.name as user_name' , 'vacations.name as vacation_name')
            ->orderBy('requests.id', 'desc')
            ->get();
        $vacations = vacation::all();
        $admin = admin::where('id', Session::get('admin_id'))->first();
        return view('vacation', compact('requests' , 'admin' , 'vacations'));
    }
    }

    public function vacation_request_action(req $request)
    {
        if(Session::has('admin_id')){

        $request->merge(['admin_id' => Session::get('admin_id')]);
        $requ = request::find($request->id);

        $requ->status = $request->status;
        $requ->update();

        return redirect()->route('vacation')->with('success', 'vacation request has been '.$request->status);
    }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreadminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreadminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateadminRequest  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateadminRequest $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
    }
}
