<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'u_id',
        'sa_address_num',
        'sa_address',
        'sa_address_detail',
    ];

    public $timestamps = false;
}
