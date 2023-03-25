<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_code', 'order_code');
    }
}
