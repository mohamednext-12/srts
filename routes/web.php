<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('pdfshow', 'SubscriptionController@pdfshow')->name('pdfshow');
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('settings', 'SettingController@index')->name('settings');
    Route::put('settings', 'SettingController@update')->name('settings.update');
    Route::post('file-upload', 'SettingController@FileLogin')->name('file-upload');
    Route::post('topbar-upload', 'SettingController@FileTopbar')->name('topbar-upload');
    Route::post('favicon-upload', 'SettingController@FileFavicon')->name('favicon-upload');
    Route::get('chains/send', 'ChainController@send')->name('chains.send');
    Route::put('chains/send', 'ChainController@storeSend')->name('chains.storeSend');
    Route::get('holograms/send', 'HologramController@send')->name('holograms.send');
    Route::put('holograms/send', 'HologramController@storeSend')->name('holograms.storeSend');
});
Route::group(['middleware' => ['role:admin|supervisor']], function () {
//    Route::get('settings', 'SettingController@index')->name('settings');
    Route::put('demands/accept/{demand}', 'DemandController@accept')->name('demands.accept');
    Route::put('demands/refuse/{demand}', 'DemandController@refuse')->name('demands.refuse');
    Route::get('shipments','ShipmentController@index')->name('shipment.index');
});
Route::group(['middleware' => ['role:admin|supervisor']], function () {
    Route::put('users/{user}/picture', 'UserController@updatePicture')->name('users.picture.update');
    Route::put('users/{user}/password', 'UserController@updatePassword')->name('users.password.update');
    Route::get('users/blocked', 'UserController@blocked')->name('users.blocked');
    Route::patch('users/{id}/restore', 'UserController@restore')->name('users.restore');
    Route::delete('users/block/{user}', 'UserController@block')->name('users.block');
    Route::resource('users', 'UserController');

    Route::get('agencies/blocked', 'AgencyController@blocked')->name('agencies.blocked');
    Route::patch('agencies/{id}/restore', 'AgencyController@restore')->name('agencies.restore');
    Route::delete('agencies/block/{agency}', 'AgencyController@block')->name('agencies.block');
    Route::resource('agencies', 'AgencyController');


    Route::resource('subscriptionCategories', 'SubscriptionCategoryController');
    Route::resource('subscriptionPeriods', 'SubscriptionPeriodController');
    Route::resource('chains', 'ChainController');
    Route::resource('holograms', 'HologramController');

    Route::get('lines/blocked', 'LineController@blocked')->name('lines.blocked');
    Route::patch('lines/{id}/restore', 'LineController@restore')->name('lines.restore');
    Route::delete('lines/block/{line}', 'LineController@block')->name('lines.block');
    Route::resource('lines', 'LineController');
    Route::get('lines/order/{line}','LineController@order')->name('line.order');
    Route::post('lines/order/{line}','LineController@orderstore')->name('line.order.save');
    Route::get('lines/getstations/{id}', 'LineController@getStations');

    Route::get('institutions/blocked', 'InstitutionController@blocked')->name('institutions.blocked');
    Route::patch('institutions/{id}/restore', 'InstitutionController@restore')->name('institutions.restore');
    Route::delete('institutions/block/{institution}', 'InstitutionController@block')->name('institutions.block');
    Route::resource('institutions', 'InstitutionController');

    Route::resource('buses', 'BusController');
    Route::resource('stations', 'StationController');
    Route::resource('demands', 'DemandController');
    Route::resource('declarations', 'DeclarationController');
    Route::resource('deliveries', 'DeliveryController');
    Route::resource('logs', 'LogActivityController');
    Route::resource('socials', 'SocialController');
    Route::post('socials/import', 'SocialController@import')->name('socials.import');
    Route::get('rapports', 'RapportController@index')->name('rapports');

});
Route::get('/v1/verifref/{chain?}','SubscriptionController@verifref')->name('ajax.verifref');
Route::get('/','HomeController@index')->name('home');
//Locale Route
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::group(['middleware' => 'auth'], function () {
Route::resource('clients', 'ClientController');
Route::resource('subscriptions', 'SubscriptionController');

Route::view('/editor','editor.index');
Route::get('pdf/{id}','SubscriptionController@generatePDF')->name('pdf');
Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
Route::get('{any}', 'RoutingController@root')->name('any');
});
//Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {

//});


// landing
//Route::get('', 'RoutingController@index')->name('index');
