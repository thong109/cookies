<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'id';
    protected $table = 'tbl_danhmuc';

    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id');
    }
}
