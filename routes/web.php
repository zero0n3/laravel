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
use App\Models\Photo;

//Route::get('/','HomeController@index');
Route::get('/','AlbumsController@index');

Route::get('welcome/{name?}/{lastname?}/{age?}', 'WelcomeController@welcome')

  /*
  ->where('name','[a-zA-Z]+')
  ->where('lastname','[a-zA-Z]+');
  */
  ->where([
    'name' => '[a-zA-Z]+',
    'lastname' => '[a-zA-Z]+',
    'age' => '[0-9]{1,3}'
  ]);

//lego
  Route::get('/moc','LegosController@index');
  Route::get('/parts','LegosController@parts');
//fine lego


Route::get('/albums','AlbumsController@index')->name('albums');
Route::get('/albums/{id}','AlbumsController@show')->where('id', '[0-9]+');
Route::get('/albums/create','AlbumsController@create')->name('album.create');
Route::get('/albums/{id}/edit','AlbumsController@edit');
Route::delete('/albums/{album}','AlbumsController@delete')->where('album', '[0-9]+');
Route::patch('/albums/{id}','AlbumsController@store')->where('id', '[0-9]+');
Route::post('/albums','AlbumsController@save')->name('album.save');
Route::get('/albums/{album}/images','AlbumsController@getImages')
          ->name('album.getimages')
          ->where('album', '[0-9]+');

Route::get('usersnoalbum',function(){
  $usersnoalbum = DB::table('users as u')
  ->leftJoin('albums as a','u.id','a.user_id')
  ->select('u.id','email','name','album_name')
  ->whereNull('album_name')
  ->get();
  return $usersnoalbum;
});

Route::get('photos',function(){
    return Photo::all();

});

//images
Route::resource('photos', 'PhotosController');
