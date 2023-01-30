<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LuckyController;
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
    return redirect()->route('register');
});

Route::get('register', [AuthController::class, 'register'])->name('register');

Route::group(['prefix' => 'user'], function () {
    Route::post('add', [UserController::class, 'create'])->name('user.create');
});

Route::group(['prefix' => 'game'], function () {
    Route::post('new', [GameController::class, 'game'])->name('game.new');
    Route::get('history', [GameController::class, 'history'])->name('game.history');
});

Route::group(['prefix' => 'link'], function () {
    Route::get('info/{code}', [LinkController::class, 'info'])->name('link.info');
    Route::post('new', [LinkController::class, 'new'])->name('link.new');
    Route::put('deactivate', [LinkController::class, 'deactivate'])->name('link.deactivate');
});

Route::group(['prefix' => 'error'], function () {
    Route::get('link', [ErrorController::class, 'linkError'])->name('error.link');
});
