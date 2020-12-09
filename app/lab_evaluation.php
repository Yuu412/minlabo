<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\lab_evaluation
 *
 * @property int $id
 * @property string $lab_name
 * @property string $lab_univ
 * @property int $user_id
 * @property int $prof_care
 * @property int $prof_friendly
 * @property int $prof_jobhunt
 * @property int $prof_network
 * @property int $prof_experience
 * @property float $prof_average
 * @property int $job_major
 * @property int $job_small
 * @property int $job_jobhunt
 * @property int $job_recommendation
 * @property int $job_reserch
 * @property float $job_average
 * @property int $lab_restraint
 * @property int $lab_event
 * @property int $lab_free
 * @property int $lab_advice
 * @property int $lab_communication
 * @property int $lab_popularity
 * @property float $lab_average
 * @property int $other_skill
 * @property int $other_fac
 * @property int $other_regret
 * @property int $other_international
 * @property int $other_gender
 * @property float $other_average
 * @property string $content
 * @property string $objobtype
 * @property float $all_average
 * @property string $token
 * @property string $add_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $Laboratory
 * @property-read int|null $laboratory_count
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereAllAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereJobAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereJobJobhunt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereJobMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereJobRecommendation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereJobReserch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereJobSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabAdvice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabCommunication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabPopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabRestraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereLabUniv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereObjobtype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereOtherAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereOtherFac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereOtherGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereOtherInternational($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereOtherRegret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereOtherSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereProfAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereProfCare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereProfExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereProfFriendly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereProfJobhunt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereProfNetwork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lab_evaluation whereUserId($value)
 * @mixin \Eloquent
 */
class lab_evaluation extends Model
{
    protected $table = 'lab_evaluation';

}
