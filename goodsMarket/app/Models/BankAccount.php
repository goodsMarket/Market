<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'u_id',
        'ba_bank_name',
        'ba_account_num',
        'ba_account_owner',
    ];

    public $timestamps = false;
}
