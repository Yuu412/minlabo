<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lab_evaluation extends Model
{
    protected $table = 'lab_evaluation';
    //belongsTo設定
    public function Laboratory()
    {
      return $this->hasMany('app\User', 'id', 'user_id');
    }
}
