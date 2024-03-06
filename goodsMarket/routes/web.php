<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UsedTradeControlloer;
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

// Route::get('/{any?}', function () {
//     return view('welcome');
// })->where('any', '.*');

Route::get('/logout', [UserController::class, 'logout']); // 로그아웃
// input 값 있는 애들
Route::middleware('trim')->group(function () {
    Route::prefix('/regist')->group(function () {
        Route::post('/part', [UserController::class, 'regist_part']); // 부분 체크
        Route::post('/mail', [EmailController::class,'send']); // 메일 인증 발송
        Route::post('/mail/check', [EmailController::class,'check']); // 메일 인증 확인
        Route::post('/sms', [SMSController::class,'send']); // SMS 인증 발송
        Route::post('/sms/check', [SMSController::class,'check']); // SMS 인증 확인
    });
    Route::post('/regist', [UserController::class, 'registration'])->middleware(['regist.val','regist.email.val','regist.sms.val']); // 가입
    Route::post('/login', [UserController::class, 'authenticate'])->middleware('login.val'); // 로그인
    // 게시글 작성
    Route::get('/board', [ListController::class, 'index_ut']);
    Route::prefix('/board')->middleware(['login.chk', 'wri.val'])->group(function () {
        Route::get('/used-trade', [ListController::class, 'index_ut']);
        Route::post('/used-trade', [UsedTradeControlloer::class, 'store_ut'])->middleware('ut.val');// 중고 작성
    });
});


// Route::get('/board/image', [ImageUploadController::class, 'index']);
// Route::post('/board/image', [ImageUploadController::class, 'store']); // 이미지 업로드