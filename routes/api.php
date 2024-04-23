<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\NewsController;
use App\Http\Middleware\Authorization;

Route::middleware([Authorization::class])->group(function () {
    Route::prefix('news')->group(function(){
        Route::get('/news', [NewsController::class, 'index']);
        Route::get('/getall', [NewsController::class, 'getLatestNews']);
        Route::get('/getwithSub/{categoryname}', [NewsController::class, 'searchNews']);
        Route::get('/getbyid/{id}', [NewsController::class, 'getNewsById']);
        Route::post('/create', [NewsController::class, 'createNew']);
        Route::put('/update/{id}',[NewsController::class, 'updateNew']);
        Route::delete('/delete/{id}',[NewsController::class,'deleteNew']);
    });
});

