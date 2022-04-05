<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','max:255',
                function($attribute,$value,$fail){
                                 if($value=='coffee')
                                 {
                                     $fail('The '.$attribute.' is invalid');
                                 }
                    }],
            'detail'=>'required',
            'price'=>'required',
            'category'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>':attribute  is Required.'
        ];
    }

    public function attributes()
    {
        return [
            'detail'=>'product detail'
        ];
    }
}
