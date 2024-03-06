<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_id',
        'consumer_id',
        'sw_id',
        'sa_id',
        'ba_id',
        'pr_order_number',
        'twitter_id',
        'instagram_id',
        'pr_order_status',
        'pr_card_success_flg',
        'pr_answer',
        'pr_compony',
        'pr_number',
        'pr_refund_request',
    ];
}
