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
    Route::post('auth/edit_profile', 'UserController@edit_profile');
    Route::post('auth/change_password', 'UserController@change_password');
    Route::post('auth/change_user_image', 'UserController@change_user_image');
    Route::post('logout', 'UserController@logout');
    Route::post('franchise/register', 'FranchiseController@register_franchise');
    Route::post('franchise/edit_franchise', 'FranchiseController@edit_franchise');
    Route::post('franchise/edit_franchise_logo_banner', 'FranchiseController@edit_franchise_logo_banner');
    Route::post('franchise/upload_legal_doc','FranchiseController@upload_legal_doc');
    Route::post('franchise/document_status','FranchiseController@document_status');
    Route::post('franchise/franchise_list','FranchiseController@franchise_list');
    Route::post('franchise/new_franchise','FranchiseController@new_franchise');
    Route::post('franchise/favorite_status','FranchiseController@favorite_status');
    Route::post('franchise/favorite','FranchiseController@favorite');
    Route::post('franchise/unfavorite','FranchiseController@unfavorite');
    Route::post('franchise/my_favorite','FranchiseController@my_favorite');
    Route::post('franchise/my_franchise','FranchiseController@my_franchise');
    Route::post('franchise/hot_franchise','FranchiseController@hot_franchise');
    Route::post('franchise/franchise_list_by_category','FranchiseController@franchise_list_by_category');
    Route::post('franchise/add_brochure','FranchiseController@add_brochure');
    Route::post('franchise/get_brochures','FranchiseController@get_brochures');
    Route::post('franchise/delete_brochure','FranchiseController@delete_brochure');
    Route::post('franchise/add_franchisee','FranchiseController@add_franchisee');
    Route::post('franchise/get_franchisee','FranchiseController@get_franchisee');
    Route::post('franchise/get_outlets','FranchiseController@get_outlets');
    Route::post('franchise/edit_outlet','FranchiseController@edit_outlet');
    Route::post('franchise/allow_review','FranchiseController@allow_review');
    Route::post('franchise/add_review_rating','FranchiseController@add_review_rating');
    Route::post('franchise/get_review_rating','FranchiseController@get_review_rating');
    Route::post('franchise/get_notifications_count','FranchiseController@get_notifications_count');
    Route::post('franchise/get_notifications','FranchiseController@get_notifications');
    Route::post('franchise/read_notification','FranchiseController@read_notification');
    Route::post('franchise/add_event','FranchiseController@add_event');
    Route::post('franchise/get_events','FranchiseController@get_events');
    Route::post('franchise/allow_book_event','FranchiseController@allow_book_event');
    Route::post('franchise/book_event','FranchiseController@book_event');
    Route::post('franchise/my_booked_events','FranchiseController@my_booked_events');
    Route::post('franchise/franchise_list_by_alphabet','FranchiseController@franchise_list_by_alphabet');
    Route::post('franchise/franchise_list_by_price_range','FranchiseController@franchise_list_by_price_range');
});
