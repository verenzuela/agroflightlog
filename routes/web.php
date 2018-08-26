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
|Route::resource('users', 'UsersController');
|
|Verb    Path                        Action  Route Name
|GET     /users                      index   users.index
|GET     /users/create               create  users.create
|POST    /users                      store   users.store
|GET     /users/{user}               show    users.show
|GET     /users/{user}/edit          edit    users.edit
|PUT     /users/{user}               update  users.update
|DELETE  /users/{user}               destroy users.destroy
|
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
		Route::resource('/flights', 'App\FlightsController')
			;//->middleware(['permission:country-list']);


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



	


	
		

	








