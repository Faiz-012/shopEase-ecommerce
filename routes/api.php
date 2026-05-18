<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'Login']);

Route::group(['middleware'=>"auth:sanctum"],function(){
Route::get('/article',[UserController::class,'getData']);
Route::post('/article',[UserController::class,'store']);   
Route::put('/article/{id}',[UserController::class,'update']); 
Route::delete('/article/{id}',[UserController::class,'delete']);
Route::get('/SearchApi/{title}',[UserController::class,'Search']);  //Search..
});
