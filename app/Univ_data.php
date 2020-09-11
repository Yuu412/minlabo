<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Univ_data
 *
 * @property int $id
 * @property string $pre_name
 * @property string $univ_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Laboratory[] $Laboratory
 * @property-read int|null $laboratory_count
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data query()
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data wherePreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data whereUnivName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Univ_data whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Univ_data extends Model
{
  protected $table = 'univ_data';

  public function Laboratory()
  {
     return $this->hasMany(Laboratory::class);
  }
}
