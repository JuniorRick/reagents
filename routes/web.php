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

Route::get('/', function () {

    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function() {
  Route::get('/producers', 'ProducerController@index');
  Route::post('/producer/store', 'ProducerController@store');
  Route::post('/producer/{id}/update', 'ProducerController@update');

  Route::get('/producer/{id}/edit', 'ProducerController@edit');
  Route::get('/producer/{id}/delete', 'ProducerController@delete');


  Route::get('/people', 'PersonController@index');
  Route::post('/person/store', 'PersonController@store');
  Route::post('/person/{id}/update', 'PersonController@update');

  Route::get('/person/{id}/edit', 'PersonController@edit');
  Route::get('/person/{id}/delete', 'PersonController@delete');


  Route::get('/reagents', 'ReagentController@index');
  Route::get('/reagents/all', 'ReagentController@reagentsJSON');

  Route::get('/reagent/{id}', 'ReagentController@reagent');
  Route::get('/reagents/{id}', 'ReagentController@reagents');

  Route::post('/reagent/store', 'ReagentController@store');
  Route::post('/reagent/{id}/update', 'ReagentController@update');


  Route::get('/reagent/{id}/edit', 'ReagentController@edit');
  Route::get('/reagent/{id}/delete', 'ReagentController@delete');


  Route::get('/orders', 'OrderController@index');
  Route::get('/orders/all', 'OrderController@orders');

  Route::post('/orders/store', 'OrderController@store');
  Route::post('/orders/bulkstore', 'OrderController@bulkstore');
  Route::post('/order/{id}/update', 'OrderController@update');

  Route::get('/order/{id}/edit', 'OrderController@edit');
  Route::get('/order/{id}/delete', 'OrderController@delete');

  Route::get('/reports/{id}', 'ReportController@reports');
  Route::post('/reports/store', 'ReportController@store');

  Route::get('/report/{id}/edit', 'ReportController@edit');
  Route::post('/report/{id}/update', 'ReportController@update');

  Route::get('/report/{id}/delete', 'ReportController@delete');
});
