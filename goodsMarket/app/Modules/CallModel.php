<?php
namespace App\Modules;

class CallModel
{
    /**
     * 최근 게시물
     * 
     * @param array $modelLimit
     * @param int $offset
     */
    protected function recent($modelLimit, $offset){
        return $modelLimit[0]::orderByDesc('created_at')
                ->take($modelLimit[1])
                ->skip($offset)
                ->get();
    }

    /**
     * 최근 거래
     * 
     * @param array $modelLimit
     * @param int $offset
     */
    protected function sold_out($modelLimit, $offset){
        return $modelLimit[0]::where('u_count', 0)
                ->orderByDesc('created_at')
                ->take($modelLimit[1])
                ->skip($offset)
                ->get()
                ->random();
    }
    
    /**
     * 최근 본 게시물
     * 
     * 요구
     * @param array $modelLimit
     * @param int $offset
     */
    protected function recent_see($modelLimit, $offset){
        

        return $modelLimit[0]::where('u_count', 0)
                ->orderByDesc('created_at')
                ->take($modelLimit[1])
                ->skip($offset)
                ->get();
    }
}