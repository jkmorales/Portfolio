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

Route::get('request/solicitudes/{estatus}','RequestController@solicitudes');
Route::get('request/solicitudesUsuarios/{id}','RequestController@solicitudesUsusarios');
Route::post('request/autorizar/{id}','RequestController@autorizar');
Route::get('request/denegar/{id}','RequestController@denegar');
Route::post('request/firmar/','RequestController@firmar');
Route::post('request/solicitudes/{id}','RequestController@update');
Route::get('teamLeaders','RequestController@getTeamLeaders');
Route::post('login','RequestController@login');
Route::get('logout/{id}','RequestController@logout');
Route::get('isLoggedPMO','RequestController@isLoggedPMO');

Route::resources([
    //'generalOption' => 'GeneralOptionController',
    //'profile'       => 'ProfileController',
    //'recordStatus'  => 'RecordStatusController',
    'request'       => 'RequestController',
    //'signature'     => 'SignatureController',
    //'workOrder'     => 'WorkOrderController',
    //'users'         => 'UserController'
]);