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

Route::group([
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localize' ]
	],
	function()
	{
		Auth::routes();

		Route::get('/', ['middleware' => ['auth'], 'uses' => 'CashflowController@index']);
		Route::get('/home', 'CashflowController@index')->name('home');

		Route::get('user-list', ['middleware' => ['auth'], 'uses' => 'AuthController@user_list']);
		Route::get('user/edit/{id}', ['middleware' => ['auth'], 'uses' => 'AuthController@userEdit']);
		Route::post('user/update', ['middleware' => ['auth'], 'uses' => 'AuthController@update']);
		Route::get('user/{id}/delete', ['middleware' => ['auth'], 'uses' => 'AuthController@destroy']);

		Route::resource('languages', 'LanguageController');
		
		Route::get('cashflow/generate_pdf', ['middleware' => ['auth'], 'uses' => 'CashflowController@generate_pdf']);

		Route::get('cashflow/generate_excel', ['middleware' => ['auth'], 'uses' => 'CashflowController@generate_excel']);
		
		Route::resource('cashflow', 'CashflowController');

	});

	//Clear Config cache:
	Route::get('/config-cache', function() {
	    $exitCode = Artisan::call('config:cache');
	    echo '<h1>Config cache cleared</h1>';
	});
	
	//Clear Cache facade value:
	Route::get('/clear-cache', function() {
	    $exitCode = Artisan::call('cache:clear');
	    echo '<h1>Cache facade value cleared</h1>';
	});

	//Run migration files
	Route::get('/migrate', function() {
	    $exitCode = Artisan::call('migrate');
	    echo '<h1>db successfully migrated</h1>';
	});

	Route::get('/seed', function() {
	    $exitCode = Artisan::call('db:seed');
	    echo '<h1>seeding has completed.</h1>';
	});

	//Reoptimized class loader:
	Route::get('/optimize', function() {
	    $exitCode = Artisan::call('optimize');
	    echo '<h1>Reoptimized class loader</h1>';
	});

	//Clear View cache:
	Route::get('/view-clear', function() {
	    $exitCode = Artisan::call('view:clear');
	    echo '<h1>View cache cleared</h1>';
	});

	//Route cache:
	Route::get('/route-cache', function() {
	    $exitCode = Artisan::call('route:cache');
	    echo '<h1>Routes cached</h1>';
	});

	//Clear Route cache:
	Route::get('/route-clear', function() {
	    $exitCode = Artisan::call('route:clear');
	    echo '<h1>Route cache cleared</h1>';
	});


	Route::get('/composer-dump', function() {
	    system('composer dump-autoload -o');
	    echo '<h1>Composer Dumped Auto load</h1>';
	});
	

	
