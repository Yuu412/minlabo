<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Laboratory
 *
 * @property int $id
 * @property int $user_id
 * @property string $lab_univ
 * @property string $lab_faculty
 * @property string $lab_department
 * @property string $lab_name
 * @property string $add_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Univ_data $univ_data
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereLabDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereLabFaculty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereLabName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereLabUniv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laboratory whereUserId($value)
 * @mixin \Eloquent
 */
class Laboratory extends Model
{
  //hasMany設定
//  public function lab_evaluation()
//  {
//     return $this->hasMany('app\User', 'id', 'user_id');
//  }

  public function univ_data()
  {
     return $this->belongsTo(Univ_data::class);
  }
}
