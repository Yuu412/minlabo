<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pre_image
 *
 * @property int $id
 * @property string $pre_name
 * @property string $pre_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image wherePreImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image wherePreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pre_image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Prefecture_image extends Model
{
  protected $table = 'prefecture_images';
}
