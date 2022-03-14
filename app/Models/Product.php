<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','detail','price','category','type','color','image','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

   /* public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = Auth::user()->id;
    }*/
    /*public function setTypeAttribute($value)
    {
        $this->attributes['type'] = json_encode($value);
    }*/

    /*public function getTypeAttribute($value)
    {
        return $this->attributes['type'] = json_decode($value);
    }*/
}
