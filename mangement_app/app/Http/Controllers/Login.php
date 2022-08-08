<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\User;
use App\Models\activities;
use Hash;
use Session;
class Login extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_check(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $admin = admin::where('email', $email)->first();
        $user = User::where('email', $email)->first();
        if ($admin) {
            if (Hash::check($password, $admin->password)) {
                Session::put('admin_id', $admin->id);
                return redirect('/dashboard');
            } else {
                return redirect('/login')->with('error', 'Password is incorrect');
            }
        } elseif ($user) {
            if (Hash::check($password, $user->password)) {
                Session::put('user_id', $user->id);
                Session::put('clock_in' , date('H:i:s'));
                return redirect()->route('user_dashboard');
            } else {
                return redirect('/login')->with('error', 'Password is incorrect');
            }
        } else {
            return redirect('/login')->with('error', 'Email is incorrect');
        }
    }

    public function logout()
    {
        if(Session::has('user_id')){
            activities::create([
                'user_id' => Session::get('user_id'),
                'leave_id' => 1,
                'start' => Session::get('clock_in'),
                'end' => date('H:i:s'),
                'date' => date('Y-m-d'),

            ]);
            Session::forget('user_id');
            Session::forget('clock_in');
        }
        if(Session::has('admin_id')){
            Session::forget('admin_id');
        }
        return redirect('/login');
    }

}
