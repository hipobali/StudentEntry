<?php

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
});
Auth::routes(['verify' => true]);
Route::group(['middleware'=>'verified'], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('student_data',[
        'uses'=>"studentController@getStudent",
        'as'=>"student_data"
    ]);
    Route::post('studentData',[
        'uses'=>"studentController@postStudent",
        'as'=>'studentData'
    ]);
    Route::get('/image_post/{img_name}',[
        'uses'=>"studentController@imagePost",
        'as'=>'image_post'

    ]);
    Route::get('/getDelete/{id}',[
        'uses'=>"studentController@getDelete",
        'as'=>"getDelete"
    ]);
    Route::get('/getUpdate/{id}',[
        'uses'=>"studentController@getUpdate",
        'as'=>"getUpdate"
    ]);
    Route::post('updateData',[
        'uses'=>"studentController@updateData",
        'as'=>'updateData'
    ]);
});





