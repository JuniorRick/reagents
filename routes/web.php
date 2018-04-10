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

// Route::group(['middleware' => ['auth']], function()
// {
//   Route::get('/table', function() {
//     return view('test');
//   });
// });


Route::get('/reagents', 'ReagentController@index');
Route::get('/reagent/{id}', 'ReagentController@reagent');
Route::get('/reagents/{id}', 'ReagentController@reagents');

Route::post('/reagent/store', 'ReagentController@store');
Route::post('/reagent/{id}/update', 'ReagentController@update');


Route::get('/reagent/{id}/edit', 'ReagentController@edit');
Route::get('/reagent/{id}/delete', 'ReagentController@delete');


Route::get('/orders', 'OrderController@index');

Route::post('/order/store', 'OrderController@store');
Route::post('/order/{id}/update', 'OrderController@update');

Route::get('/order/{id}/edit', 'OrderController@edit');
Route::get('/order/{id}/delete', 'OrderController@delete');
