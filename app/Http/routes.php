<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
	Route::resource('reg', 'PhotoController') or Route::post('reg', 'PhotoController'); // When user request to send data for insert, update, delete
	Route::get('/home', 'HomeController@index'); //When user request a page 
*/

Route::get('/', function () {
    //return view('welcome');
});

Route::get('/about', function () {
    //return view('welcome');
    return 'This is About Page';
});

Route::get('/form', function () {
    return view('simple_project/form');
});


Route::get('edit/{id}', 'SimpleController@edit');
Route::get('delete/{id}', 'SimpleController@destroy');
Route::post('update/{id}', 'SimpleController@update');

//Route::post('/insert', 'SimpleController@store'); /*in Form If we use Form::open(array('route' => 'insert')) or 'url' => 'insert'*/
//Route::resource('/insert', 'SimpleController@store'); /*in Form If we use Form::open(array('route' => 'route.name'))*/
Route::post('/insert', 'SimpleController@store'); /*in Form If we use Form::open(array('action' => 'Controller@method'))*/
Route::get('/showalldata', 'SimpleController@index');//Data received

Route::group(['middleware' => 'web'], function () {
  	
});


