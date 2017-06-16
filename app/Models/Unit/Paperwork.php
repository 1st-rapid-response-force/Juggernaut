<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paperwork
 *
 * @package App\Models\Unit
 * @property int $id
 * @property int $member_id
 * @property int $processor_id
 * @property string $type
 * @property string $paperwork
 * @property int $status
 * @property int $team_id
 * @property int $appeal
 * @property int $disciplinary_team_id
 * @property int $disciplinary_member_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Unit\Member $member
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\PaperworkMessage[] $notes
 * @property-read \App\Models\Unit\Member $processor
 * @property-read \App\Models\Unit\Team $team
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork disciplinary()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork standard()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereAppeal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereDisciplinaryMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereDisciplinaryTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork wherePaperwork($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereProcessorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Paperwork whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Paperwork extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['processor_id','type','paperwork','status','team_id','disciplinary_member_id','disciplinary_team_id' ,'appeal'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processor()
    {
        return $this->belongsTo('App\Models\Unit\Member','processor_id');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\Unit\PaperworkMessage','paperwork_id');
    }

    public function scopeStandard($query)
    {
        return $query->where('type', 'discharge')
            ->orWhere('type', 'file-correction')
            ->orWhere('type', 'leave')
            ->orWhere('type', 'program-completion')
            ->orWhere('type', 'flight-plan')
            ->orWhere('type', 'change-request')
            ->orWhere('type', 'aar');
    }

    public function scopeDisciplinary($query)
    {
        return $query->where('disciplinary_member_id', '!=',null);
    }

    /**
     * @return mixed
     */
    public function getPaperwork()
    {
        return json_decode($this->paperwork);
    }

    /**
     * @return string
     */
    public function getType()
    {
        switch ($this->type){
            case 'discharge':
                return 'Discharge Form';
                break;
            case 'file-correction':
                return 'File Correction Form';
                break;
            case 'bad-conduct':
                return 'Bad Conduct Form';
                break;
            case 'leave':
                return 'Leave of Absence Form';
                break;
            case 'program-completion':
                return 'Program Completion Form';
                break;
            case 'flight-plan':
                return 'Flight Plan';
                break;
            case 'change-request':
                return 'Change Request';
                break;
            case 'aar':
                return 'After Action Report';
                break;
            case 'article-15':
                return 'Article 15';
                break;
            case 'ncs':
                return 'Negative Counseling Statement';
                break;
        }
    }

    /**
     * @return string
     */
    public function getAppealType()
    {
        switch ($this->appeal){
            case 1:
                return 'Appeal Requested';
                break;
            case 2:
                return 'Appeal Under Review';
                break;
            case 3:
                return 'Appeal Denied';
                break;
        }
    }

    public function getDisciplinaryRoute()
    {
        switch ($this->type){
            case 'article-15':
                return 'frontend.disciplinary.article';
                break;
            case 'ncs':
                return 'frontend.disciplinary.ncs';
                break;
            default:
                return 'frontend.files.my-file';
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        switch ($this->status){
            case 1:
                return '<span class="label label-info">PENDING REVIEW</span>';
                break;
            case 2:
                return '<span class="label label-info">REVIEWED</span>';
                break;
            case 3:
                return '<span class="label label-info">ARCHIVED</span>';
                break;
            case 4:
                return '<span class="label label-warning">MORE INFORMATION NEEDED</span>';
                break;
            case 10:
                return '<span class="label label-success">CHANGE IMPLEMENTED</span>';
                break;
            case 11:
                return '<span class="label label-warning">CHANGE ON HOLD</span>';
                break;
            case 12:
                return '<span class="label label-danger">CHANGE DECLINED</span>';
                break;
        }
    }

    public function getAppealStatus()
    {
        switch ($this->appeal){
            case 1:
                return '<span class="label label-info">APPEAL REQUESTED</span>';
                break;
            case 2:
                return '<span class="label label-info">APPEAL UNDER REVIEW</span>';
                break;
            case 3:
                return '<span class="label label-danger">APPEAL DENIED</span>';
                break;
        }
    }

}
