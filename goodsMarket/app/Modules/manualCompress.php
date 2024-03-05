<?php

use App\Modules\FilesInDirectory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

$manager = new ImageManager(Driver::class);

$fileSearch = new FilesInDirectory('D:\kkh\Market\goodsMarket\public\images\samples');

foreach ($fileSearch->returnFileNames as $key => $value) {
    $image = $manager->read('D:\kkh\Market\goodsMarket\public\images\samples\\'.$value);
    
    $image->resize(height: 300);
    
    $encoded = $image->toJpg();
    
    $encoded->save(public_path('\\images\\thumbnail_samples\\') . '.jpg');
    
    $compressedImage = time() . $post->id . rand(000, 999) . '.jpg';
}