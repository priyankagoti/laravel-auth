<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    //use SoftDeletes;
    use Prunable;

    protected $touches=['owner'];
    protected $appends=['name_with_detail'];
    protected $casts=['price'=>PriceCast::class];
    protected $fillable=[
        'name','detail','price','category','type','color','image','user_id','country_name','city_name'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function prunable()
    {
        return static::where('created_at', '<=', now()->subHour());
    }

    public function getNameWithDetailAttribute($value){
        $value="{$this->name} {$this->detail}";
        return ucwords($value);
    }

    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function getDetailAttribute($value){
        return ucfirst($value);
    }

    public function setNameAttribute($value){
        return $this->attributes['name']=strtoupper($value);
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
