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

//admin

Route::group([ 'as'=>'admin.', 'prefix'=>'admin' , 'namespace'=>'Admin', 'middleware'=>['auth','admin']],
function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});


//landlord

Route::group([ 'as'=>'landlord.','prefix'=>'landlord' , 'namespace'=>'Landlord', 'middleware'=>['auth','landlord']],
function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::resource('area','AreaController');
	Route::resource('house','HouseController');
});


//renter

Route::group([ 'as'=>'renter.','prefix'=>'renter' , 'namespace'=>'renter', 'middleware'=>['auth','renter']],
function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});


