<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/chart', 'ChartController@index');
Route::resource('expenses', 'ExpenseController');
Route::resource('companies', 'CompanyController');
Route::resource('invoices', 'InvoiceController');

Route::get('/search-companies','CompanyController@search');
Route::get('/search-invoices','InvoiceController@search');

