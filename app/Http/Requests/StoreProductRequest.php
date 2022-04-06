<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
   // protected $stopOnFirstFailure = true;
   // protected $redirectRoute = 'products.index';
    public function authorize()
    {
       // $product = Product::find($this->route('products.update'));
        //return $this->user()->can('update', $this->product);
      //  return $product && $this->user()->can('update', $product);
         return true;
    }
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
            'name.required'=>'The :attribute  is Required.'
        ];
    }

    public function attributes()
    {
        return [
            'detail'=>'product detail'
        ];
    }

}
