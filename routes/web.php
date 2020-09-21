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
	Route::resource('area','AreaController');
	Route::resource('house', 'HouseController');
	Route::get('manage-landlord', 'HouseController@manageLandlord')->name('manage.landlord');
	Route::delete('manage-landlord/destroy/{id}', 'HouseController@removeLandlord')->name('remove.landlord');

	Route::get('manage-renter', 'HouseController@manageRenter')->name('manage.renter');
	Route::delete('manage-renter/destroy/{id}', 'HouseController@removeRenter')->name('remove.renter');

	Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
	Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
	Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');

});


//landlord

Route::group([ 'as'=>'landlord.','prefix'=>'landlord' , 'namespace'=>'Landlord', 'middleware'=>['auth','landlord']],
function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::resource('area','AreaController');
	Route::resource('house','HouseController');
	Route::get('house/switch-status/{id}','HouseController@switch')->name('house.status');

	Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
	Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
	Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');
});


//renter

Route::group([ 'as'=>'renter.','prefix'=>'renter' , 'namespace'=>'renter', 'middleware'=>['auth','renter']],
function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});


