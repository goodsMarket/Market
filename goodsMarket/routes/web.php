<?php

use App\Http\Controllers\BoardController;
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

Route::get('/', function () {
    return view('welcome');
})->middleware(['logchk']);


// Route::get('/{any?}', function () {
//     return view('welcome');
// })->where('any', '.*');

Route::middleware(['trim','my.regist.val'])->post('/regist', [UserController::class,'registration']);
Route::middleware(['trim','my.user.val'])->post('/login', [UserController::class,'authenticate']);
Route::middleware(['trim','my.board.val'])->post('/used-trade', [BoardController::class,'createUsedTrade']);