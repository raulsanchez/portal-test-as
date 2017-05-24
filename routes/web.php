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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/assignedasd', 'RolesController@assigned')->name('roles.assigned');
        Route::post('/assign', 'RolesController@assign')->name('roles.assign');
        Route::delete('/remove', 'RolesController@remove')->name('roles.remove');
    });
    Route::resource('roles', 'RolesController');

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/assigned', 'PermissionsController@permsAssigned');
        Route::post('/assign', 'PermissionsController@assign');
        Route::delete('/remove', 'PermissionsController@remove');
    });
    Route::resource('permissions', 'PermissionsController');
    Route::resource('users', 'UsersController');

    Route::resource('users_types', 'UsersTypesController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
