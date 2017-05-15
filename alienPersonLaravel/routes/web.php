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

Route::get('/home', 'HomeController@index');

Route::get('/data/search', 'DataController@search');
Route::get('/data/allPerson', 'DataController@allPerson');
Route::post('/data/addHome', 'DataController@addHome');
Route::post('/data/updateHome/{id}', 'DataController@updateHome');

Route::get('/checkbk', 'CheckBkController@index');

Route::resource('/data', 'DataController');

// user route
Route::get('/allUsers', 'UserController@index');
Route::get('/user/{id}/edit', 'UserController@edit');
Route::delete('/user/{id}', 'UserController@destroy');

// Route::get('/data', 'DataController@index');

// Route::get('/data/create', 'DataController@create');
// Route::post('/data/create', 'DataController@store');
// Route::get('/data/{{id}}/edit', 'DataController@edit');
// Route::post('/data/{{id}}/edit', 'DataController@update');

// API
Route::post('/api/getPersonByFullName', 'ApiController@getPersonByFullName');
Route::post('/api/getPersonById', 'ApiController@getPersonById');

Route::get('/api/allPerson', 'ApiController@allPerson');
Route::get('/api/allUsers', 'ApiController@allUsers');

Route::post('/api/getAddresses', 'ApiController@getAddresses');

Route::get('/api/codes/', function(){
    $data['preName'] = App\Cprename::all();
    $data['mStatus'] = App\Cmstatus::all();
    $data['education'] = App\Ceducation::all();
    $data['occupation'] = App\Coccupation::all();
    $data['religion'] = App\Creligion::all();
    $data['fstatus'] = App\Cfstatus::all();
    $data['typearea'] = App\Ctypearea::all();
    $data['hospital'] = App\Chospital::all();
    $data['nation'] = App\Cnation::all();
    return $data;
});

Route::get('/api/hospcodes/', function(){
    $data['hospital'] = App\Chospital::all();
    return $data;
});
