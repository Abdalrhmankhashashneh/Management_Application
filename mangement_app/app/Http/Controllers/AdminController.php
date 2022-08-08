<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\User;
use App\Models\activities;
use App\Models\request;
use App\Models\vacation;
use App\Models\offdayuser;
use Validator;


use Hash;
use Session;
use DateTime;
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
            $now = new DateTime();


            $admin = admin::where('id', Session::get('admin_id'))->first();

            return view('index', compact('users' , 'activities' , 'admin'));
    }

    public function create_user()
    {
        $admin = admin::where('id', Session::get('admin_id'))->first();
        return view('add_user' , compact('admin'));
    }

    public function add_user(req $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'major' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('/admin/user/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->major = $request->major;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('dashboard');
    }


    public function edit_user($id){
        $user = User::find($id);
        $admin = admin::where('id', Session::get('admin_id'))->first();
        return view('edit_user' , compact('user' , 'admin'));
    }

    public function update_user($id){
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->birthday = request('birthday');
        $user->major = request('major');
        $user->update();
        return redirect()->route('dashboard');
    }

    public function delete_user($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('dashboard')->with( 'success_deleted', 'User Deleted Successfully');
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
    else{
        $requests = request::join('users', 'users.id', '=', 'requests.user_id')
        ->join( 'vacations', 'vacations.id', '=', 'requests.vacation_id')
            ->select('requests.*', 'users.name as user_name' , 'vacations.name as vacation_name')
            ->where('requests.user_id', Session::get('user_id'))
            ->orderBy('requests.id', 'desc')
            ->get();
            $vacations = vacation::all();
            $user = User::where('id', Session::get('user_id'))->first();
            return view('vacation', compact('requests' , 'user' , 'vacations'));
    }
    }


    public function request_vacation()
    {
        $vacations = vacation::all();
        $user = User::where('id', Session::get('user_id'))->first();
        return view('request_vacation' , compact('vacations' , 'user'));
    }

    public function add_request(req $request)
    {

        $requestv = new request();
        $requestv->user_id = Session::get('user_id');
        $requestv->vacation_id = $request->vacation_id;
        $requestv->date = $request->date;
        $requestv->save();
        return redirect()->route('vacation');
    }


    public function vacation_request_action(req $request)
    {
        if(Session::has('admin_id')){

        $request->merge(['admin_id' => Session::get('admin_id')]);
        $requ = request::find($request->id);
        if($request->status == 'Accepted'){
        $useroff = offdayuser::where('date', $requ->date)->first();
        if($useroff){
            return redirect()->route('vacation')->with('danger', ' there is a vacation on this date');
        }}
        $requ->status = $request->status;
        $requ->update();

        if($request->status == 'Accepted'){
             offdayuser::create([
                'user_id' => $requ->user_id,
                'date' => $requ->date,
                'vacation_id' => $requ->vacation_id,
            ]);
        }

        return redirect()->route('vacation')->with('success', 'vacation request has been '.$request->status);
    }

}

public function create_vacation(){
    if(Session::has('admin_id')){
        $admin = admin::where('id', Session::get('admin_id'))->first();
        return view('vacation_create', compact('admin'));
    }
}

public function add_vacation(req $request)
{
    if(Session::has('admin_id')){
    vacation::create([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('vacation')->with('success_add', 'vacation has been added');
}
}

public function edit_vacation($id)
{
    if(Session::has('admin_id')){
    $vacation = vacation::find($id);
    $admin = admin::where('id', Session::get('admin_id'))->first();
    return view('edit_vacation', compact('vacation' , 'admin'));
}
}

public function update_vacation($id){
    if(Session::has('admin_id')){
    $vacation = vacation::find($id);
    $vacation->update([
        'name' => request()->name,
        'description' => request()->description,
    ]);
    return redirect()->route('vacation')->with('success_update', 'vacation has been updated');
}
}



public function delete_vacation($id){
    if(Session::has('admin_id')){
    vacation::destroy($id);
    return redirect()->route('vacation')->with('success_delete', 'vacation has been deleted');
}
}

public function offusers(){
    if(Session::has('admin_id')){
    $offusers = offdayuser::join('users', 'users.id', '=', 'offdayusers.user_id')
    ->join('vacations', 'vacations.id', '=', 'offdayusers.vacation_id')
    ->select('offdayusers.*', 'users.name as user_name' , 'vacations.name as vacation_name')
    ->orderBy('offdayusers.id', 'desc')
    ->get();
    $admin = admin::where('id', Session::get('admin_id'))->first();
    return view('offuser', compact('offusers' , 'admin'));
    }
    else{
        $offusers = offdayuser::join('users', 'users.id', '=', 'offdayusers.user_id')
        ->join('vacations', 'vacations.id', '=', 'offdayusers.vacation_id')
        ->select('offdayusers.*', 'users.name as user_name' , 'vacations.name as vacation_name')
        ->orderBy('offdayusers.id', 'desc')
        ->get();
        $user = User::where('id', Session::get('user_id'))->first();
        return view('offuser', compact('offusers' , 'user'));
    }

}


}
