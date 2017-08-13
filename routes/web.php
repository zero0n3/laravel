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

Route::get('/','HomeController@index');

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

Route::get('/albums','AlbumsController@index');
Route::delete('/albums/{id}/delete','AlbumsController@delete');
Route::get('/albums/{id}','AlbumsController@show');


Route::get('/photos',function(Request $res){
    $q = Photo::select('*');

    if($res::has('album_id')){
        $photos = $q->where('album_id',$res::get('album_id'))->paginate(20);
    } else {

    }

});
