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
}
