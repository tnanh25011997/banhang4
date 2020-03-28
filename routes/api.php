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

//api
Route::get('api-price/{slug}',['as'=>'api-price','uses'=>'APIController@getAPIPrice']);
Route::get('api-newest-product',['as'=>'api-newest-product','uses'=>'APIController@getNewestProduct']);
Route::get('api-sale-product',['as'=>'api-sale-product','uses'=>'APIController@getSaleProduct']);
Route::get('api-best-seller',['as'=>'api-best-seller','uses'=>'APIController@getBestSeller']);
Route::get('api-list-category/{slug}',['as'=>'api-list-category','uses'=>'APIController@getListCategory']);
Route::get('api-cheapest-unit-price-product-in-category/{slug}',['as'=>'api-cheapest-unit-price-product-in-category','uses'=>'APIController@getCheapestUnitPriceProductInCategory']);
Route::get('api-cheapest-promotion-price-product-in-category/{slug}',['as'=>'api-cheapest-promotion-price-product-in-category','uses'=>'APIController@getCheapestPromotionPriceProductInCategory']);
Route::get('api-list-product-of-category/{slug}',['as'=>'api-list-product-of-category','uses'=>'APIController@getListProductOfCategory']);
Route::get('api-list-product-of-brand/{slug}',['as'=>'api-list-product-of-brand','uses'=>'APIController@getListProductOfBrand']);
Route::get('api-promotion-product-in-category/{slug}',['as'=>'api-newest-product-in-category','uses'=>'APIController@getPromotionProductInCategory']);
Route::get('api-best-seller-in-category/{slug}',['as'=>'api-best-seller','uses'=>'APIController@getBestSellerInCategory']);


