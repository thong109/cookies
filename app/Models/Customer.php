<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';

    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    // }
}
