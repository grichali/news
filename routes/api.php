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



Route::prefix('news')->group(function(){
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/getall', [NewsController::class, 'GetLatestNews']);
    Route::get('/getbyid/{id}', [NewsController::class, 'GetNewsById']);
    Route::post('/create', [NewsController::class, 'CreateNew']);
    Route::put('/update/{id}',[NewsController::class, 'UpdateNew']);
    Route::delete('/delete/{id}',[NewsController::class,'DeleteNew']);
});
