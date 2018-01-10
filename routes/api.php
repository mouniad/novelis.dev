<?php
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

Route::group(['middleware' => 'api','prefix' => 'contact'], function(){
    Route::get('/list', 'ContactsController@all');
    Route::get('/{id}', 'ContactsController@item');
    Route::post('/store', 'ContactsController@store');
    Route::put('/update/{id}', 'ContactsController@update');
    Route::delete('/delete/{id}', 'ContactsController@destroy');
    Route::group(['middleware' => 'api', 'prefix' => 'group'], function(){
        Route::get('/list', 'GroupsController@all');
        Route::get('/{id}', 'GroupsController@item');
        Route::post('/store', 'GroupsController@store');
        Route::put('/update/{id}', 'GroupsController@update');
        Route::delete('/delete/{id}', 'GroupsController@destroy');
    });
});


Route::middleware('api')->get('phone-types', 'HelpController@phoneTypes');