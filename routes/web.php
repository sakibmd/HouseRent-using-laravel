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

Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/descending-order-houses-price', 'HomeController@highToLow')->name('highToLow');
Route::get('/ascending-order-houses-price', 'HomeController@lowToHigh')->name('lowToHigh');


Route::get('/search-result', 'HomeController@search')->name('search');
Route::get('/search-result-by-range', 'HomeController@searchByRange')->name('searchByRange');

Route::get('/houses/details/{id}', 'HomeController@details')->name('house.details');
Route::get('/all-available/houses', 'HomeController@allHouses')->name('house.all');
Route::get('/available-houses/area/{id}', 'HomeController@areaWiseShow')->name('available.area.house');


Route::post('/house-booking/id/{id}', 'HomeController@booking')->name('booking');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//admin

Route::group([ 'as'=>'admin.', 'prefix'=>'admin' , 'namespace'=>'Admin', 'middleware'=>['auth','admin', 'verified']],
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


	Route::get('booked-houses-list', 'BookingController@bookedList')->name('booked.list');
	Route::get('booked-houses-history', 'BookingController@historyList')->name('history.list');

});


//landlord

Route::group([ 'as'=>'landlord.','prefix'=>'landlord' , 'namespace'=>'Landlord', 'middleware'=>['auth','landlord', 'verified']],
function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::resource('area','AreaController');
	Route::resource('house','HouseController');
	Route::get('house/switch-status/{id}','HouseController@switch')->name('house.status');


	Route::get('booking-request-list','BookingController@bookingRequestListForLandlord')->name('bookingRequestList');
	Route::post('booking-request/accept/{id}','BookingController@bookingRequestAccept')->name('request.accept');
	Route::post('booking-request/reject/{id}','BookingController@bookingRequestReject')->name('request.reject');
	Route::get('booking/history','BookingController@bookingHistory')->name('history');
	Route::get('booked/currently/renter','BookingController@currentlyStaying')->name('currently.staying');
	Route::post('renter/leave/{id}','BookingController@leaveRenter')->name('leave.renter');


	Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
	Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
	Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');
});


//renter

Route::group([ 'as'=>'renter.','prefix'=>'renter' , 'namespace'=>'renter', 'middleware'=>['auth','renter', 'verified']],
function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');

	Route::get('areas', 'DashboardController@areas')->name('areas');

	Route::get('houses', 'DashboardController@allHouses')->name('allHouses');
	Route::get('house/details/{id}', 'DashboardController@housesDetails')->name('houses.details');


	Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
	Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
	Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');





	Route::get('booking/history','DashboardController@bookingHistory')->name('booking.history');
	Route::get('pending/booking','DashboardController@bookingPending')->name('booking.pending');
	Route::post('pending/booking/cancel/{id}','DashboardController@cancelBookingRequest')->name('cancel.booking.request');
});


