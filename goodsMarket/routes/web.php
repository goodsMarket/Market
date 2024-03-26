<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\UserController;
use App\Modules\ManualCompress;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['login.chk']);


// Route::get('/{any?}', function () {
//     return view('welcome');
// })->where('any', '.*');
// input 값 있는 애들
Route::middleware('trim')->group(function () {
    Route::middleware('regist.val')->post('/regist', [UserController::class, 'registration']);
    Route::middleware('login.val')->post('/login', [UserController::class, 'authenticate']);
    // 게시글 작성
    Route::middleware(['login.chk', 'wri.val'])->group(function () {
        Route::middleware('ut.val')->post('/board/used-trade', [BoardController::class, 'createUsedTrade']);
        // Route::middleware('p.val')->post('/board/production', [BoardController::class,'createProduction']);
    });
});
Route::get('board/image', [ImageUploadController::class, 'index']);
Route::post('board/image', [ImageUploadController::class, 'store'])->name('image.upload');
Route::put('board/image', [ImageUploadController::class, 'compress']); // 압축용