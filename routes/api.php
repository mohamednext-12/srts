<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/v1/munByreg/{region?}','InstitutionController@MunByReg')->name('api.munbyreg');
Route::get('/v1/classBylevel/{level?}','SubscriptionController@ClassByLevel')->name('api.classbylevel');
Route::get('/v1/instBymunlev/{municipality?}/{level?}','SubscriptionController@InsByMunLev')->name('api.instbymunlev');
Route::get('/v1/phaseByperiod/{period?}','SubscriptionController@PhaseByPeriod')->name('api.phasebyperiod');
Route::get('/v1/getmandat/{mandat?}/{prix?}','SubscriptionController@getMandat')->name('api.getmandat');
Route::get('/v1/getprice/{line?}/{cat?}','SubscriptionController@getprice')->name('api.getprice');

Route::post('/v1/verifcin','SubscriptionController@verifcin')->name('ajax.verifcin');
Route::post('/v1/verifpayment','SubscriptionController@verifpayment')->name('ajax.verifpayment');
Route::post('/v1/verifage','SubscriptionController@verifage')->name('ajax.verifage');
Route::post('/v1/verifagecivile','SubscriptionController@verifagecivile')->name('ajax.verifagecivile');

Route::get('/v1/lotByreceipt/{receipt?}','ChainController@LotByReceipt')->name('api.lotbyreceipt');
