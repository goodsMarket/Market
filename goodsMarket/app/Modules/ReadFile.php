<?php

namespace App\Modules;

class ReadFile
{
    public $file_path, $target_line_number, $file;
    
    /**
     * 어느파일에 어느줄 찾을지
     * 
     * @param string $file_path '파일경로.txt'
     * @param int $target_line_number 찾을 줄
     */
    public function __construct($file_path, $target_line_number){
        // 파일 경로
        $this->file_path = public_path($file_path);
        
        // 찾고자 하는 줄 번호
        $this->target_line_number = $target_line_number;
        
        // 파일 열기
        $this->file = fopen($this->file_path, 'r');
    }
    
    public function read(){

        if ($this->file) {
            // 파일 크기 확인
            $file_size = filesize($this->file_path);
            
            $start = 0;
            $end = $file_size;
            $found = false;

            // 이진 탐색
            while ($start <= $end) {
                $mid = floor(($start + $end) / 2);
                fseek($this->file, $mid); // 파일 포인터 이동

                // 현재 위치에서 다음 줄로 이동 (한 줄 읽어오는거 아닌가?)
                fgets($this->file);

                // 현재 위치의 줄 번호 가져오기
                $current_line = count(file($this->file_path, FILE_SKIP_EMPTY_LINES));

                // 찾고자 하는 줄 번호와 비교
                if ($current_line == $this->target_line_number) {
                    $found = true;
                    break;
                } elseif ($current_line < $this->target_line_number) {
                    // 중간값보다 찾고자 하는 줄 번호가 더 뒤쪽에 있음
                    $start = $mid + 1;
                } else {
                    // 중간값보다 찾고자 하는 줄 번호가 더 앞쪽에 있음
                    $end = $mid - 1;
                }
            }

            if ($found) {
                // 파일 포인터 이동
                fseek($this->file, $mid);

                // 찾은 줄 출력
                echo fgets($this->file);
            } else {
                echo "해당 줄을 찾을 수 없습니다.";
            }

            // 파일 닫기
            fclose($this->file);
        } else {
            // 파일 열기에 실패한 경우 에러 메시지 출력
            echo "파일을 열 수 없습니다.";
        }
    }
}