<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function login(){
        if(!Auth::guard('admin')->user()){
            return view('admin.auth.login');
        }
        else{
            return redirect()->back();
        }
    }

    public function check(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {
            // Authentication successful
            return redirect()->route('admin')->with('admin_login','Welcome Mr.'.Auth::guard('admin')->user()->name);

        } else {
            // Authentication failed
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }
}
