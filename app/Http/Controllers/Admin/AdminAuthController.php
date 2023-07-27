<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\validationRequests;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{


    public function login(){

        return view('admin.auth.login');
    }

    public function check(LoginRequest $request){

        $request->validated();
        // return $request;
        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {
            // Authentication successful
            return redirect()->route('admin.home')->with('admin_login','Welcome Mr.'.Auth::guard('admin')->user()->name);

        }else{
            return redirect()->route('admin.login')->with('authentication_failed','Email or password invalid')->withInput($request->all());
        }
            // Authentication failed

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
