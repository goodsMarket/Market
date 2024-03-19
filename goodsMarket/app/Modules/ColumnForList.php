<?php
namespace App\Modules;

class ColumnForList
{
    /** 리스트에 뽑을 애들 저장 */
    public static $forList = [
        'used_trades' => [
            'used_trades.id',
            'ut_title',
            'ut_thumbnail',
            'ut_price',
            'used_trades.created_at',
        ],
        'productions' => [
            'productions.id',
            'u_nickname',
            'u_profile_img',
            'p_title',
            'p_start_date',
            'p_end_date',
            'p_thumbnail',
            'p_view',
        ],
    ];
}