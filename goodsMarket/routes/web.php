<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UserController;
use App\Modules\ManualCompress;
use Illuminate\Support\Facades\DB;
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
// })->middleware(['logchk']);


Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');

Route::middleware(['trim','my.user.val'])->post('/regist', [UserController::class,'registration']);
Route::middleware(['trim','my.user.val'])->post('/login', [UserController::class,'authenticate']);
// })->where('any', '.*');

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
    Route::post('/login', [UserController::class, 'authenticate']); // 로그인
    // 게시글 작성
    Route::middleware(['login.chk', 'wri.val'])->group(function () {
        Route::post('/board/used-trade', [BoardController::class, 'createUsedTrade'])->middleware('ut.val'); // 중고 작성
        // Route::middleware('p.val')->post('/board/production', [BoardController::class,'createProduction']); // 제작 작성
    });
});

Route::get('/board', []);

Route::get('/board/image', [ImageUploadController::class, 'index']);
Route::post('/board/image', [ImageUploadController::class, 'store']); // 이미지 업로드