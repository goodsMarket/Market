<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UserController;
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

// input 값 있는 애들
Route::middleware('trim')->group(function () {
    Route::post('/regist/part', [UserController::class, 'regist_part']); // 부분 체크
    Route::post('/mail', [EmailController::class,'send']); // 메일 인증 발송
    Route::post('/mail/check', [EmailController::class,'check']); // 메일 인증 확인
    Route::post('/mail/check-back', [EmailController::class,'check_back']); // 메일 인증 확인
    Route::middleware('regist.val')->post('/regist', [UserController::class, 'registration']); // 가입
    Route::middleware('login.val')->post('/login', [UserController::class, 'authenticate']); // 로그인
    Route::post('sms', [SMSController::class, 'send']); // SMS test
    // 게시글 작성
    Route::middleware(['login.chk', 'wri.val'])->group(function () {
        Route::middleware('ut.val')->post('/board/used-trade', [BoardController::class, 'createUsedTrade']); // 중고 작성
        // Route::middleware('p.val')->post('/board/production', [BoardController::class,'createProduction']); // 제작 작성
    });
});
Route::get('board/image', [ImageUploadController::class, 'index']);
Route::post('board/image', [ImageUploadController::class, 'store'])->name('image.upload'); // 이미지 업로드