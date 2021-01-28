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

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\V1',
    "middleware" => ['auth:api']
], function () {
    Route::apiResources([
        'clients' => 'ClientController',
        'rooms' => 'RoomController',
        'bookings' => 'BookingController'
    ]);

    Route::get('bookings/{booking}/relationships/client', 'BookingRelationShipController@client')->name('bookings.relationships.client');
    Route::get('bookings/{booking}/client', 'BookingRelationShipController@client')->name('bookings.client');

    Route::get('bookings/{booking}/relationships/room', 'BookingRelationShipController@room')->name('bookings.relationships.room');
    Route::get('bookings/{booking}/room', 'BookingRelationShipController@room')->name('bookings.room');
});

Route::post('login', 'Api\V1\AuthController@login');
Route::post('signup', 'Api\V1\AuthController@signup');
