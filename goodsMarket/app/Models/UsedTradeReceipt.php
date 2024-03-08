<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedTradeReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'utr_order_number',
        'ut_id',
        'consumer_id',
        'shipment_id',
        'sa_id',
        'utr_price',
        'utr_count',
        'utr_card_success_flg',
        'utr_refund_request',
        'utr_refunded_at',
    ];
}
