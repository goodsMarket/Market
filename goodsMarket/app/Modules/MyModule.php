<?php

namespace App\Modules;
use Illuminate\Support\Facades\Log;

class MyModule
{
    /**
     * 쿠키, 세션용 암호화1
     * 
     * @param string 암호화할 문자열
     * @return string 암호화 된 문자열
     */
    public static function myEncrypt($secret)
    {
        return MyModule::mySecoundEncrypt(base64_encode($secret . env('SALT_VALUE')));
    }

    /**
     * 쿠키, 세션용 암호화2
     * 
     * @param string 소금만 뭍히고 1차 암호화된 문자열
     * @return string 앞뒤 바꾸고 암호화한 문자열
     */
    public static function mySecoundEncrypt($secret2)
    {
        $cuttingIndex = strlen($secret2) / 2;
        $front = substr($secret2, 0, $cuttingIndex);
        $behind = substr($secret2, $cuttingIndex);
        return base64_encode($behind . $front);
    }

    /**
     * 쿠키, 세션용 복호화
     * @param string 앞뒤 바꾸고 암호화한 문자열
     * @return string 복호화된 문자열
     */
    public static function myDecrypt($secret)
    {
        $decoded = base64_decode($secret);
        // Log::debug('myDecrypt');
        // Log::debug($decoded);
        $cuttingIndex = strlen($decoded) / 2;
        if(strlen($decoded) % 2 !== 0){
            $behinded = substr($decoded, 0, $cuttingIndex + 1);
            $fronted = substr($decoded, $cuttingIndex + 1);
        } else {
            $behinded = substr($decoded, 0, $cuttingIndex);
            $fronted = substr($decoded, $cuttingIndex);
        }

        $myDecrypt = MyModule::mySecoundDecrypt($fronted . $behinded);
        // Log::debug('result');
        // Log::debug($myDecrypt);

        return $myDecrypt;
    }

    /**
     * 쿠키, 세션용 복호화2
     * 
     * @param string 앞뒤 안바뀐 암호화한 문자열
     * @return string 소금 안친 복호화된 문자열
     */
    public static function mySecoundDecrypt($secret)
    {
        $decoded = base64_decode($secret);
        // Log::debug('mySecoundDecrypt');
        // Log::debug($decoded);
        $mySecountDecrypt = str_replace(env('SALT_VALUE'), '', $decoded);
        return $mySecountDecrypt;
    }

    /**
     * faker용 날짜 짜집기
     * $rand,$cre,$rand1_1,$ver,$rand2,$upd,$rand3,$del,$deleted
     * 
     * @return array 작성일 < 수정일 (with 특정일a)< 삭제일
     */
    public static function fakerTimeGenerate()
    {
        $rand = rand(1, 365);
        $cre = now()->subDays($rand);
        $rand1_1 = $rand - (rand(1, $rand));
        $ver = now()->subDays($rand1_1);
        $rand2 = $rand - (rand(1, $rand));
        $upd = $cre->addDays($rand2);
        $rand3 = $rand2 - (rand(1, $rand2));
        $del = $upd->addDays($rand3);
        $deleted = rand(0,9); // 'deleted_at' => $deleted > 2 ? $del : null,

        return [
            'rand' => $rand, 
            'rand1_1' => $rand1_1, 
            'rand2' => $rand2, 
            'rand3' => $rand3, 
            'ver' => $ver, 
            'cre' => $cre, 
            'upd' => $upd, 
            'del' => $del, 
            'deleted' => $deleted
        ];
    }
}
