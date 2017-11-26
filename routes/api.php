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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('auth/register', 'UserController@register');
Route::post('auth/login', 'UserController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('user', 'UserController@getAuthUser');
    Route::post('logout', 'UserController@logout');
    Route::post('franchise/register', 'FranchiseController@register_franchise');
    Route::post('franchise/upload_legal_doc','FranchiseController@upload_legal_doc');
    Route::post('franchise/document_status','FranchiseController@document_status');
});
