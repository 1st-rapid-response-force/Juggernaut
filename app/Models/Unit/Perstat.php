<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\Perstat
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property int $assigned
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Member[] $members
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Perstat whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Perstat whereAssigned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Perstat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Perstat whereFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Perstat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Perstat whereTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Perstat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Perstat extends Model
{
    protected $guarded = [];


    public function members()
    {
        return $this->belongsToMany('App\Models\Unit\Member', 'member_perstat', 'perstat_id', 'member_id');
    }

    public function report_percentage()
    {
        $reportin = $this->members->count();
        $percentage = ($reportin/$this->assigned)*100;
        return round($percentage,2);
    }
    public function pendingReportIn()
    {
        $reportedIn = $this->members;
        $members = Member::where('active','=','1')->get();
        $members = $members->diff($reportedIn);
        return $members;
    }
}
