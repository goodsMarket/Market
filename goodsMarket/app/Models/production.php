<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'u_id',
        'c_id',
        'p_title',
        'p_start_date',
        'p_end_date',
        'p_schedule',
        'p_content',
        'p_age_limit',
        'p_password',
        'p_thumbnail',
        'p_notice_agreement',
        'p_twitter',
        'p_instagram',
        'p_question',
    ];
}
