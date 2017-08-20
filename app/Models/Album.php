<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {
//nel caso i nomi non coincidessero
  protected $table = 'albums';
  protected $primaryKey = 'id';
  protected $fillable = [
    'album_name',
    'description',
    'user_id'
  ];

  public function getPathAttribute(){
    $url = $this->album_thumb;
    if(stristr($this->album_thumb, 'http') === false){
      $url = 'storage/' . $this->album_thumb;
    }
    return $url;
  }

  public function photos(){
    return $this->hasMany(Photo::class);
  }
}
