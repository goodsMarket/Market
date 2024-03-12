<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Production extends Model
{
    use HasFactory, SoftDeletes;
    
    
    protected $fillable = [
        'writer_id',
        'c_id',
        'p_title',
        'p_start_date',
        'p_end_date',
        'p_schedule', // 배송예정일
        'p_content',
        'p_age_limit',
        'p_password',
        'p_thumbnail',
        'p_notice_agreement',
        'p_twitter',
        'p_instagram',
        'p_question',
        'p_view',
        'p_like',
    ];
    
    protected $dates = ['deleted_at']; // deleted_at 컬럼을 날짜로 취급하도록 설정
}
