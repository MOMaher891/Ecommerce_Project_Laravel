<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\languageValidation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Views Function
     */
    public function index(){
        $languages = Language::selection()->paginate(config('app.PAGINATION'));
        return view('admin.languages.index',compact('languages'));
    }

    public function create(){
        Session::forget('success');
        return view('admin.languages.create');
    }
    public function edit($id){
        $language = Language::find($id);
        return view('admin.languages.edit',compact('language'));
    }

    /**
     * Functionality Function
     */

     public function store(languageValidation $request){
        $request->validated();
        try{
            if(Language::where('name',$request->name)->first()){
                return redirect()->back()->with('error','هذه اللغه موجوده بالفعل');
            }
            Language::create($request->except('token'));
            return redirect()->route('admin.language.home')->with('success','تم اضافه اللغه بنجاح');
        }catch(\Exception $ex){
            return redirect()->route('admin.language.home')->with('error','حدثت مشكله اثناء اضافه اللغه , حاول مره اخرى');
        }

     }

     public function update(Request $request){
        try{
            $language = Language::find($request->id);
            if(!$request->has('active')){
                $request->request->add(['active'=>0]);
                $language->update($request->except('token'));
            }else{
                $language->update($request->except('token'));
            }
            return redirect()->route('admin.language.home')->with(['success'=>'تم تعديل اللغه بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.language.home')->with('error','حدثت مشكله اثناء تعديل اللغه , حاول مره اخرى');
        }
     }

     public function delete($id){
        try{
            $language = Language::find($id);
            $language->delete();
            return redirect()->back()->with(['success'=>'تم حذف اللغه بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.language.home')->with('error','حدثت مشكله اثناء حذف اللغه , حاول مره اخرى');
        }
     }
}
