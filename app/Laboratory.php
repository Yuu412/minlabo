<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
  //hasMany設定
  public function lab_evaluation()
  {
     return $this->hasMany('app\User', 'id', 'user_id');
  }

  public function univ_data()
  {
     return $this->belongsTo(Univ_data::class);
  }
}
