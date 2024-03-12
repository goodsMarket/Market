<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request){
        return [
            'channel_name' => env('PAY_CHANNEL_NAME'),
            'channel_key' => env('PAY_CHANNEL_KEY'),
            'mid' => env('PAY_MID'),
            'api_key' => env('PAY_API_KEY'),
        ];
    }
}
