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
Route::get('/','HomeController@index');




Route::get('/{name?}/{lastname?}/{age?}', function ($name = '', $lastname = '', $age=0) {
    //return view('welcome');
    return '<h1>hello world '.$name.' '.$lastname.' '.$age.'</h1>';
})
  /*
  ->where('name','[a-zA-Z]+')
  ->where('lastname','[a-zA-Z]+');
  */
  ->where([
    'name' => '[a-zA-Z]+',
    'lastname' => '[a-zA-Z]+',
    'age' => '[0-9]{1,3
}'
  ])
;
