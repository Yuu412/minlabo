<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Univ_data extends Model
{
  protected $table = 'univ_data';

  public function Laboratory()
  {
     return $this->hasMany(Laboratory::class);
  }
}
