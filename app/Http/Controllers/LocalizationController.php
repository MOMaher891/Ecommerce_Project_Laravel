<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setLang($lang)
    {
        App::setLocale($lang);
        Session::put('local',$lang);
        return redirect()->back();
    }
}
