<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_favorite_id';
    protected $table = 'tbl_favorite';

    public function wishlist()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
