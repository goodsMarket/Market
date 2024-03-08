<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UsedTradeControlloer;
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

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');

// Route::middleware(['trim','my.user.val'])->post('/regist', [UserController::class,'registration']);
// Route::middleware(['trim','my.user.val'])->post('/login', [UserController::class,'authenticate']);
// })->where('any', '.*');

// input 값 있는 애들
Route::middleware('trim')->group(function () {
    // 가입과정
    Route::prefix('/regist')->group(function () {
        Route::post('/part', [UserController::class, 'regist_part']); // 부분 체크
        Route::post('/mail', [EmailController::class, 'send']); // 메일 인증 발송
        Route::post('/mail/check', [EmailController::class, 'check']); // 메일 인증 확인
        Route::post('/sms', [SMSController::class, 'send']); // SMS 인증 발송
        Route::post('/sms/check', [SMSController::class, 'check']); // SMS 인증 확인
    });
    Route::post('/regist', [UserController::class, 'registration'])->middleware(['regist.val', 'regist.email.val', 'regist.sms.val']); // 가입
    Route::post('/login', [UserController::class, 'authenticate'])->middleware('login.val'); // 로그인
    Route::patch('/logout', [UserController::class, 'logout']); // 로그아웃
    // 게시글
    Route::patch('/board', [ListController::class, 'index_ut']);
    Route::prefix('/board')->group(function () {
        // 리스트 출력
        Route::prefix('/list')->group(function () {
            Route::patch('/used-trade', [ListController::class, 'index_ut']);
            Route::patch('/used-trade/{page}', [ListController::class, 'index_ut']);
        });
        // 게시글 조회, 작성, 수정, 삭제
        Route::patch('/used-trade/{id}', [UsedTradeControlloer::class, 'view_ut']);
        // 로그인 해야함
        Route::middleware('login.chk')->group(function () {
            // 작성자 같아야 함 // 모듈에서 가저오기로 함
            // Route::middleware('wri.val')->group(function () {
            Route::post('/used-trade', [UsedTradeControlloer::class, 'store_ut'])->middleware('ut.val');// 중고 작성
            Route::put('/used-trade', [UsedTradeControlloer::class, 'update_ut'])->middleware('ut.val');// 중고 작성
            Route::delete('/used-trade', [UsedTradeControlloer::class, 'delete_ut']);
            // });
        });
    });
});

// Route::patch('/board/image', [ImageUploadController::class, 'index']);
// Route::post('/board/image', [ImageUploadController::class, 'store']); // 이미지 업로드