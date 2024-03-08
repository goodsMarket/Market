<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneVerified extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'pv_token',
    ];

    public $timestamps = false;
}
