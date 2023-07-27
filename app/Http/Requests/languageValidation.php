<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class languageValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string|max:100',
            'direction'=>'required|in:rtl,ltr',
            'abbr'=>'required|max:10',
            'active'=>'required|in:0,1'
        ];
    }

    public function messages(){
        return [
            'required'=>"هذا الحقل مطلوب",
            'active.required'=>'يجب تفعيل اللغه , يمكنك الغاء التفعيل بعد الاضافه',
            'string'=> "هذا الحقل يجب ان يكون نص",
            'name.max'=>"اقصى عدد لهذا الحقل 100 حرف",
            'abbr.max'=>"اقصى عدد لهذا الحقل 10 حرف",
            'active.in'=>'القيمه المحدده غير صحيحه'
        ];
    }
}
