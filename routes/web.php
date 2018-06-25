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
Route::post('/cobrar', 'TicketController@update')->name('cobrar')->middleware('auth');
Route::post('/pdf', 'TicketController@pdf')->name('pdf')->middleware('auth');
Route::post('/actualizar', 'TicketController@updateTicket')->name('actualizar')->middleware('auth');
Route::post('/eliminar', 'TicketController@deleteTicket')->name('eliminar')->middleware('auth');
Route::post('/recuperar', 'TicketController@recoveryTicket')->name('recuperar')->middleware('auth');
Route::post('/renovar', 'TicketController@renovarTicket')->name('renovar')->middleware('auth');
Route::post('/get_ticket', 'TicketController@getTicket')->name('get_ticket')->middleware('auth');
Route::post('/update_cuenta', 'PartnerController@update')->name('update_cuenta')->middleware('auth');
Route::post('/update_parking', 'ParkingController@update')->name('update_parking')->middleware('auth');
Route::post('/get_status', 'TicketController@getStatus')->name('get_status')->middleware('auth');
Route::get('/get_tickets', 'TicketController@getTickets')->name('get_tickets')->middleware('auth');
Route::get('/get_months', 'TicketController@getMonths')->name('get_months')->middleware('auth');
Route::resource('tickets', 'TicketController')->middleware('auth');