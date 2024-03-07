<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsedTrade extends Model
{
    use HasFactory, SoftDeletes;
    
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
    
    protected $dates = ['deleted_at']; // deleted_at 컬럼을 날짜로 취급하도록 설정
}
