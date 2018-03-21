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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/cobrar', 'TicketController@update')->name('cobrar');
Route::get('/get_tickets', 'TicketController@getTickets')->name('get_tickets');
Route::get('/get_months', 'TicketController@getMonths')->name('get_months');
Route::post('/get_status', 'TicketController@getStatus')->name('get_status');
Route::resource('tickets', 'TicketController');