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

Route::get('/', function () { return view('home.home'); })->name('home');
Route::get('/about', function () { return view('home.about'); })->name('about');
Route::get('/faq', function () { return view('home.faq'); })->name('faq');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
  Route::get('/list/{type}/{status}', 'ListController@viewUserList')->name('unsortedList');
  Route::get('/list/{type}/{status}/{perPage}', 'ListController@viewUserList')->name('unsortedListPaginated');
  Route::get('/list/{type}/{status}/{sortKey}/{sortOrder}', 'ListController@viewUserListSorted')->name('sortedList');
  Route::get('/list/{type}/{status}/{sortKey}/{sortOrder}/{perPage}', 'ListController@viewUserListSorted')->name('sortedListPaginated');
  Route::get('/export/{type}/{status}', 'ListController@export')->name('export');

  Route::get('/messages/delete/{type}_{id}', 'MessageController@hideMsg')->name('deleteMsg');
  Route::get('/messages/{id}/{backTo}', 'MessageController@reply')->name('reply');
  Route::get('/markAsRead/{id}', 'MessageController@markAsRead')->name('markAsRead');
  Route::get('/contact_admin/{id}', 'MessageController@recomDeleteRequest')->name('recomDelete');

  Route::get('/editprofile', 'EditProfileController@index')->name('editprofile');
  Route::get('/deletelog/{id}', 'LogController@delete')->name('log.delete');
  Route::post('/savephoto', 'EditProfileController@storePhoto')->name('storephoto');
  Route::post('/saveabout', 'EditProfileController@storeAbout')->name('storeabout');
  Route::get('/editprofile/{account}', 'EditProfileController@destroy')->name('deleteAccount');
  Route::get('/confirm_delete', 'UserController@delete')->name('confirmDelete');

  Route::resource('profile', 'ProfileController');
  Route::resource('editProfile', 'EditProfileController');
  Route::resource('messages', 'MessageController');
  Route::resource('recommendation', 'RecommendationController');
  Route::resource('log', 'LogController');
  Route::resource('user', 'UserController');
});
