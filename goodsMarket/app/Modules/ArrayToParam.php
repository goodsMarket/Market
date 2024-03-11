<?php
namespace App\Modules;

class ArrayToParam
{
    /**
     * --- 보류 ---
     * 배열을 함수에 하나씩 넣기
     * @param array $array
     */
    public static function put($func, $array) {
        foreach ($array as $key => $value) {
            ${"param" . $key} = $value;
        }
        return $param1;
    }
}