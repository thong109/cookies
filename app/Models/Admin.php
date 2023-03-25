<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'admin_id', 'admin_email', 'admin_password', 'admin_name', 'admin_phone', 'admin_address', 'admin_avatar'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
}
