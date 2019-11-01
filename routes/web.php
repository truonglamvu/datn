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

/* Admin Controller */
// Route::resource('/admin','AdminController',['middleware'=>'auth']);
/* ------------------------------------------------------------------------------ */
Route::group(["prefix" => 'admin',  'middleware' => 'auth'], function() {
	Route::get('/',function(){
		return redirect('/admin/document');
	});
	/* User Controller */
	Route::get('information-user/{id}','UserController@getInfoUser')->name('informationUser');
	Route::get('pick-role/{id}','UserController@loadRole')->name('loadRole');
	Route::post('pick-role/pick-role-store/{id}','UserController@pickRole')->name('pickRole');
	Route::post('pick-role/unpick-role-store/{id}','UserController@unPickRole')->name('unPickRole');
	Route::post('active-user/{id}','UserController@activeUser')->name('activeUser');
	Route::get('user-search','UserController@search');
	Route::get('role-search/{id}','UserController@searchRole');
	Route::get('view-change-password/{id}','UserController@viewChangePassword')->name('viewChangePassword');
	Route::put('change-password/{id}','UserController@changePassword')->name('changePassword');
	Route::get('/user/back-page','UserController@backPage')->name('userBackPage');
	Route::resource('user','UserController');
	/* ------------------------------------------------------------------------------ */

	/* Role Controller */
	Route::get('role-permission/{id}','RoleController@showPermission')->name('rolePermission');
	Route::post('role-permission/pick-permission/{id}','RoleController@pickPermission');
	Route::post('role-permission/unpick-permission/{id}','RoleController@unpickPermission');
	Route::get('/role/back-page','RoleController@backPage')->name('roleBackPage');
	Route::get('/permission-search/{id}','RoleController@searchPermission');
	Route::resource('role','RoleController');
	/* ------------------------------------------------------------------------------ */

	/* Permission Controller */
	Route::get('/permission/back-page','PermissionController@backPage')->name('permissionBackPage');
	Route::resource('permission','PermissionController');
	/* ------------------------------------------------------------------------------ */

	/* Post Controller */
	Route::get('/docs-api','PostController@home');
	Route::post('document/active/{id}','PostController@active');
	Route::get('document-search','PostController@search');
	Route::get('/document-suggest','PostController@suggest');
	Route::get('/document-user-list/{id}','PostController@listDocument')->name('listDocumentForUser');
	Route::get('/document-filter','PostController@filterDocumentByMenu');
	Route::get('/search/list-user-document/{id}','PostController@searchInListUserDocument');
	Route::get('/document/back-page','PostController@backPage')->name('documentBackPage');
	Route::get('/dumplicate-data/{id}','PostController@dumplicateData')->name('dumplicateData');
	Route::resource('document','PostController');
	/* ------------------------------------------------------------------------------ */

	/* Menu Controller */
	Route::get('menu/back-page', 'MenuController@backPage')->name('menuBackPage');
	Route::get('menu-loadrole/{id}', 'MenuController@loadRole')->name('loadRoleMenu');
	Route::put('menu-loadrole/pick-role-menu/{id}', 'MenuController@pickRole');
	Route::put('menu-loadrole/unpick-role-menu/{id}', 'MenuController@unPickRole');
	Route::resource('menu','MenuController');
	/* ------------------------------------------------------------------------------ */

	Route::get('crons/export', 'ExportController@index')->name('export');

	Route::get('/dasboard', 'PostController@dashboard')->name('dasboard');
	Route::get('/fetch-list-number-categories', 'PostController@fetchDataCategories');

});

Route::group(['middleware' => 'auth'], function() {
	/* ------------------------------------------------------------------------------ */
	/* Guest Controller */
	Route::get('/','GuestController@index');
});
/* ------------------------------------------------------------------------------ */
/* Test API */
Route::get('/run-api/{id}', 'PostController@runApi')->name("runApi");
Route::post('/test-api', 'PostController@testApi')->name('test-api');
/* ------------------------------------------------------------------------------ */
/* Login Controller */
Route::get('/guest-login','LoginController@getViewLogin')->name('gLogin');
Route::post('/guest-login-store','LoginController@login')->name('guestLogin');
Route::post('guest-logout','LoginController@logoutGuest')->name('guestLogout');
// Route::get('admin-register', 'LoginController@getViewRegisterAdmin')->name('viewRegisterAdmin');
// Route::get('guest-register', 'LoginController@getViewRegisterGuest')->name('viewRegisterGuest');
Route::post('admin-register-store', 'LoginController@register')->name('guestRegister');
// Route::get('facebook', 'Auth\AuthController@redirectToFacebook')->name('auth.facebook');
// Route::get('facebook/callback', 'Auth\AuthController@handleFacebookCallback');
Auth::routes();