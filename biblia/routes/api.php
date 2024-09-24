<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/teste', function (){
    return "Teste com sucesso";
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});
