<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/student_data',[
    'uses'=>"ApiController@getStudent",
]);
Route::post('/postStudent',[
    'uses'=>"ApiController@postStudent"
]);
Route::Delete('/post/{id}',[
    'uses'=>"ApiController@getDelete"
]);
Route::post('update',[
    'uses'=>"ApiController@updateData"
]);
Route::get('search/{q}',[
    'uses'=>"ApiController@getSearch"
]);