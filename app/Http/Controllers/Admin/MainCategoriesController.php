<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesValidations;
use App\Models\main_category;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
    /**
     * Const variables
     */
    public $Main_Categories_path = 'Uploads/Main_Categories';
    public $translation_of = 0;
    /**
     * Views Function
     */
    public function index(){
        $default_lang = get_default_lang();
        $categories = main_category::where('translation_lang',$default_lang)
                                    ->selection()
                                    ->paginate(config('app.PAGINATION'));
        return view('admin.maincategories.home',compact('categories'));

    }

    public function create(){
        return view('admin.maincategories.create');
    }
    public function edit($id){
        $language = Language::find($id);
        return view('admin.languages.edit',compact('language'));
    }

    /**
     * Functionality Function
     */

     public function store(MainCategoriesValidations $request){
        $request->validated();

         try{
            $image_name='';

            if($request->has('photo')){
                $image_name = uploadImage($request->photo,$this->Main_Categories_path);
            };
            //Make Filter To get Category name has abbr == local.app
            $main_category =collect( $request->category);
            $default_category = $main_category->filter(function($value,$key){
                return $value['abbr']==get_default_lang();
            });
            $default_category = array_values($default_category->all())[0];

            //Store Main Category Has Translation_lang == Local.lang
            //Save Main Category id to related by another langs

            $main_category_id = main_category::insertGetId([
                'name'=>$default_category['name'],
                'slug'=>$default_category['name'],
                'photo'=>$image_name,
                'translation_lang'=>$default_category['abbr'],
                'translation_of'=>0
            ]);

            //Make Filter To get All language except local lang
            $main_category =collect( $request->category);
            $other_category = $main_category->filter(function($value,$key){
                return $value['abbr']!=get_default_lang();
            });
            $other_category = array_values($other_category->all());
            //Check if founded another languages
            if(isset($other_category) && count($other_category)){
                foreach ($other_category as  $cat) {
                    main_category::create([
                        'name'=>$cat['name'],
                        'slug'=>$cat['name'],
                        'translation_lang'=>$cat['abbr'],
                        'photo'=>$image_name,
                        'translation_of'=>$main_category_id
                    ]);
                }
            }

            return redirect()->route('admin.main_Categories')->with('success','تم إضافه القسم الرئيسى بنجاح');
        }catch(\Exception $ex){
            return redirect()->route('admin.main_Categories')->with('error','حدثت مشكله اثناء اضافه القسم , حاول مره اخرى');
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
            return redirect()->route('admin.language.home')->with(['success'=>'تم تعديل القسم بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.language.home')->with('error','حدثت مشكله اثناء تعديل القسم , حاول مره اخرى');
        }
     }

     public function delete($id){
        try{
            $language = Language::find($id);
            $language->delete();
            return redirect()->back()->with(['success'=>'تم حذف القسم بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.language.home')->with('error','حدثت مشكله اثناء حذف القسم , حاول مره اخرى');
        }
     }

     public function status(Request $request){
        return $request;
     }
}
