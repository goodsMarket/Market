<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardImg extends Model
{
    use HasFactory;

    protected $fillable = [
        'bi_board_flg',
        'board_id',
        'bi_img_path',
    ];

    public $timestamps = false;
}
