<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';

    public function voucherSend(){
        return $this->belongsTo(VoucherSend::class,'coupon_id','coupon_id');
    }
}
