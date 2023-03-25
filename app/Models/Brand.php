<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'tbl_brand';


    // public function product(){
    //     return $this->hasMany('App\Product','brand_id');
    // }
    public function category()
    {
        return $this->hasOne(Danhmuc::class, 'id', 'category_id');
    }
}
