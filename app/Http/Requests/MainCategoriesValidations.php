<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoriesValidations extends FormRequest
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
            "photo"=>"required|mimes:png,jpg,jpeg",
            'category' => 'required|array|min:1',
            'category.*.name' => 'required',
            'category.*.abbr' => 'required',
        ];
    }

    public function messages(){
        return [
            "required"=>"هذا الحقل مطلوب",
            "mimes"=>"هذا الحقل يقبل الملفات من النوع ( png - jpg - jpeg ) فقط .",
        ];
    }
}
