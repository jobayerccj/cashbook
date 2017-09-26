<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'AccountsController@index');

/*
|--------------------------------------------------------------------------
|This routes are related to PartyController
|--------------------------------------------------------------------------
|@author Md. Jobayer Islam
|
*/

/*Route::get('/parties', 'PartyController@index');
Route::get('/party/add', ['as' => 'add', 'uses' => 'PartyController@add']);
Route::get('/party/{id}', 'PartyController@showDetail');
Route::get('/party/{id}/edit', 'PartyController@edit');
Route::post('/party', 'PartyController@store');
Route::delete('/party/{party}', 'PartyController@destroy');*/

Route::resource('parties', 'PartyController');

/*
|--------------------------------------------------------------------------
|This routes are related to AccountsReceivablesController
|--------------------------------------------------------------------------
|@author Md. Jobayer Islam
|
*/

Route::resource('accountsReceivables', 'AccountsReceivablesController');

/*
|--------------------------------------------------------------------------
|This routes are related to AccountsController
|--------------------------------------------------------------------------
|@author Md. Asif Rahman
|
*/
	//Route::get('/accounts','AccountsController@index');
	Route::resource('accounts','AccountsController');

/*
|--------------------------------------------------------------------------
|This routes are related to AccountsPayablesController
|--------------------------------------------------------------------------
|@author Md. Jobayer Islam
|
*/

Route::resource('accountsPayables', 'AccountsPayablesController');

/*
|--------------------------------------------------------------------------
|This routes are related to CashPaymentsController
|--------------------------------------------------------------------------
|@author Md. Jobayer Islam
|
*/

Route::resource('cashPayments', 'CashPaymentsController');

Route::auth();
Route::get('/home', 'AccountsController@index');

Route::get('auth/edit_profile', 'Auth\AuthController@edit_profile');
Route::post('auth/update_profile', 'Auth\AuthController@update_profile');
