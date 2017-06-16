<?php

namespace App\Models\Unit;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\Program
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $video
 * @property string $document
 * @property int $responsible_team_id
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $qualification_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\ProgramGoal[] $goals
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Member[] $members
 * @property-read \App\Models\Unit\Team $team
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereDocument($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereQualificationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereResponsibleTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Program whereVideo($value)
 * @mixin \Eloquent
 */
class Program extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name','description','video', 'document','responsible_team_id','status','qualification_id'];

    public function goals()
    {
        return $this->hasMany('App\Models\Unit\ProgramGoal','program_id');
    }

    public function members()
    {
        return $this->hasMany('App\Models\Unit\Member','current_program_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team', 'responsible_team_id');
    }

    public function getStatus()
    {
        switch ($this->status){
            case 1:
                return '<span class="label label-info">Open to Applicants</span>';
                break;
            case 2:
                return '<span class="label label-danger">Closed to Applicants</span>';
                break;
            case 3:
                return '<span class="label label-warning">Inactive</span>';
                break;
        }
    }


}