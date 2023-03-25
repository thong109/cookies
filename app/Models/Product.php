<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'tbl_product';

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id', 'id');
    }
}
