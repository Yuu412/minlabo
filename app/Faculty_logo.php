<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Faculty_logo
 *
 * @property int $id
 * @property string $faculty_name
 * @property string $faculty_logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo whereFacLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo whereFacName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty_logo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Faculty_logo extends Model
{
  protected $table = 'faculty_logos';
}
