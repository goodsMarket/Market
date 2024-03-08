<?php
namespace App\Modules;

use App\Modules\FilesInDirectory;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ManualCompress
{

    public $manager, $fileSearch, $path, $toPath;

    /**
     * public_path($path)의 이미지들을 압축해서 $toPath로 이동
     * @param string $path '\\'로 나눔, 맨끝에 \\없음
     */
    public function __construct($path)
    {
        $this->path = public_path($path);
        $this->manager = new ImageManager(Driver::class);
        $this->fileSearch = new FilesInDirectory($this->path);
    }

    /**
     * public_path($toPath)에, $height px정도로 (default:100), $prefix라고 앞에 달기
     * 
     * @param string $toPath '\\'로 나눔, 맨끝에 \\없음
     * @param int $height 크기 (근데 이거 300이 기본인듯, 짜그러짐)
     * @param string $prefix 앞에 이름
     */
    public function compress($toPath, $height, $prefix = null)
    {
        foreach ($this->fileSearch->fileNames as $key => $fileName) {
            $image = $this->manager->read($this->path . '\\' . $fileName);
            $image->resize(height: $height);
            $encoded = $image->toJpg();

            $info = pathinfo($fileName);
            $newFileName = $prefix . '_' . time() . rand(000, 999) . '_' . $info['filename'] . '.jpg';
            $encoded->save(public_path($toPath) . '\\' . $newFileName);
        }
    }

}