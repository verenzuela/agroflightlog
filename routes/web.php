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

	Route::auth();
	
	Route::get('/', 'HomeController@index')->name('home');
	
	Route::group(['middleware' => ['auth']], function() {

		Route::get('/home', 'HomeController@index')->name('home');

		//PROFILE
		Route::prefix('/profile')->group(function ()
		{
			Route::get('/view', 'ProfileController@index')->name('profile.view');
			Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
			Route::post('/update/{id}', 'ProfileController@update')->name('profile.update');
			Route::post('/update/password/{id}', 'ProfileController@change_password')->name('profile.update.password');
			
		});


		//APP
		Route::prefix('/app')->group(function ()
		{
			Route::get('/index', 'App\AppController@index')->name('app.dashboard');
			//Route::get('/profile', 'App\AppController@profile')->name('app.profile');

			
		});



		//FLIGHTS
		Route::prefix('/flights')->group(function ()
		{
			Route::get('/list', 'App\FlightsController@list')->name('flights.list');

			Route::get('/new', 'App\FlightsController@new')->name('flights.new');
			
		});



		//ADMIN
		Route::prefix('/admin')->group(function ()
		{
			Route::get('/index', 'Admin\AdminController@index')->name('admin.dashboard');

			Route::get('/users', 'Admin\UsersController@index')->name('admin.users');

			
			
		});


		/* USERS */
		Route::post('user-management/search', 'Admin\UserManagementController@search')
			->name('user-management.search');

		Route::resource('user-management','Admin\UserManagementController')
			->middleware(['permission:user-list']);

		/* ROLES */
		Route::resource('access-management/roles','Admin\RoleController')
			->middleware(['permission:role-list']);

		/* PERMISSION */
		Route::resource('access-management/permission','Admin\PermissionController')
			->middleware(['permission:permission-list']);

	});



	


	
		

	








