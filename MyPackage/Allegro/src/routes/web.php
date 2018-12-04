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

// Route::get('/', function () {
    // return view('login');
// });
// MyVendor\allegro\src\routes\web.php
Route::get('contact', function(){
	return 'Hello from the contact form package';
});
Route::group(['namespace' => 'MyPackage\allegro\App\Http\Controllers', 'middleware' => ['web']], function(){
	Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard');
	Route::get('admin/auth/token/', 'Admin\DashboardController@getAuthtoken')->name('auth.token');
	Route::get('admin/auction/', 'Admin\AuctionController@index')->name('my.auction');
	Route::any('admin/add/auction/', 'Admin\AuctionController@createAuction')->name('create.auction');
	Route::any('admin/auction/add', 'Admin\AuctionController@addAuction')->name('create.auction.add');
});
/*Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
Route::get('admin/auth/token/', 'Admin\DashboardController@getAuthtoken')->name('auth.token');
Route::get('admin/auction/', 'Admin\AuctionController@index')->name('my.auction');
Route::any('admin/add/auction/', 'Admin\AuctionController@createAuction')->name('create.auction');
Route::any('admin/auction/add', 'Admin\AuctionController@addAuction')->name('create.auction.add');*/



