<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  protected $table = 'department';

  public function Laboratory()
  {
      return $this->hasMany('App\Laboratory', 'department_id');
  }
}
