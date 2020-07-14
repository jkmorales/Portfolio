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

Route::get('index', 'UserController@index')->name('index');

Route::resources([
    'generalOption' => 'GeneralOptionController',
    'profile'       => 'ProfileController',
    'recordStatus'  => 'RecordStatusController',
    //'request'       => 'RequestController',
    'signature'     => 'SignatureController',
    'workOrder'     => 'WorkOrderController',
    'users'         => 'UserController'
]);

Route::post('login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::get('/','Auth\LoginController@showLoginForm');