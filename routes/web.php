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
Route::post('/pdf', 'TicketController@pdf')->name('pdf');
Route::post('/actualizar', 'TicketController@updateTicket')->name('actualizar');
Route::post('/eliminar', 'TicketController@deleteTicket')->name('eliminar');
Route::post('/recuperar', 'TicketController@recoveryTicket')->name('recuperar');
Route::post('/renovar', 'TicketController@renovarTicket')->name('renovar');
Route::post('/get_ticket', 'TicketController@getTicket')->name('get_ticket');
Route::post('/update_account', 'PartnerController@update')->name('update_cuenta');
Route::post('/get_status', 'TicketController@getStatus')->name('get_status');
Route::get('/get_tickets', 'TicketController@getTickets')->name('get_tickets');
Route::get('/get_months', 'TicketController@getMonths')->name('get_months');
Route::resource('tickets', 'TicketController');