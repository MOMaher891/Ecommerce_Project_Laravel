<?php

namespace App\Http\Controllers;

use App\Models\main_category;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function index(){
        $default_lang = get_default_lang();
        $categories = main_category::where('translation_lang',$default_lang)
                                    ->selection()
                                    ->paginate(config('app.PAGINATION'));

        return view('admin.maincategories.home',compact('categories'));
    }
}
