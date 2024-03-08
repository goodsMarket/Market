<?php
namespace App\Modules;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class FilesInDirectory
{
    public $fileNames = [];

    /**
     * 폴더 주면 폴더 안의 파일 이름 꺼낼 수 있음
     * 
     * @param string $folder 폴더이름
     * 
     * 멤버변수 array $fileNames 파일 이름 배열 가져다 쓰셈
     */
    public function __construct($folderForSearch)
    {
        $folders = File::files($folderForSearch);
        foreach ($folders as $folder) {
            $file = pathinfo($folder);
            $this->fileNames[] = $file['basename'];
        }
    }
}