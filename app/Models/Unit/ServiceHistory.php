<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\ServiceHistory
 *
 * @property int $id
 * @property int $member_id
 * @property string $text
 * @property string $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Unit\Member $member
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ServiceHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ServiceHistory whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ServiceHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ServiceHistory whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ServiceHistory whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ServiceHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServiceHistory extends Model
{
    protected $fillable = ['text','date'];

    protected $date = ['date'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }
}
