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

Route::post('/reagent/store', 'ReagentController@store');

Route::get('/reagent/{id}/edit', 'ReagentController@edit');
Route::get('/reagent/{id}/delete', 'ReagentController@delete');
