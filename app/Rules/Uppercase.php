<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule,DataAwareRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
     protected $data=[];
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $strData = strtoupper($value);
        if ($strData===$value){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.uppercase');
    }

    public function setData($data)
    {
        $this->data=$data;
        return $this;
    }
}
