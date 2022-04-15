<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PriceCast implements CastsAttributes{
    public function get($model, $key, $value, $attributes){
        return $value/10;
    }

    public function set($model, $key, $value, $attributes){
        return $value*100;
    }
}
