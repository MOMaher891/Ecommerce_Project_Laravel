<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FrontController extends Controller
{
    public function index(){
        return view('front.home');
    }
}
