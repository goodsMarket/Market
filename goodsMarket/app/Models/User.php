<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    protected $fillable = [
        "u_name",
        "u_nickname",
        "u_email",
        "u_pw",
        "u_phone_num",
        "u_agree_flg",
    ];
}
