<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedTrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'writer_id',
        'c_id',
        'ut_title',
        'ut_thumbnail',
        'ut_price',
        'ut_count',
        'ut_quality',
        'ut_description',
        'ut_refund',
    ];
}
