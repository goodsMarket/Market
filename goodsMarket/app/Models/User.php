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
        "k_id",
        "n_id",
        "u_name",
        "u_nickname",
        "u_back_img",
        "u_email",
        "u_pw",
        "u_profile_img",
        "u_acc_token",
        "u_phone_num",
        "u_pccc",
        "u_agree_flg",
        "u_adult_flg",
    ];
}
