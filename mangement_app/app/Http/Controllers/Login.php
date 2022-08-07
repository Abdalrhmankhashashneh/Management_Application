<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\User;
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
                return redirect('/dashboard');
            } else {
                return redirect('/login')->with('error', 'Password is incorrect');
            }
        } else {
            return redirect('/login')->with('error', 'Email is incorrect');
        }
    }

}
