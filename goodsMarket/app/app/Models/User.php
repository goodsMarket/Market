<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements MustVerifyEmail
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
