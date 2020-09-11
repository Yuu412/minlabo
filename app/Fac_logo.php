<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Fac_logo
 *
 * @property int $id
 * @property string $fac_name
 * @property string $fac_logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo whereFacLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo whereFacName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fac_logo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fac_logo extends Model
{
  protected $table = 'fac_logos';
}
