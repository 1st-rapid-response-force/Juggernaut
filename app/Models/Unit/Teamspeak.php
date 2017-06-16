<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\Teamspeak
 *
 * @property int $id
 * @property int $member_id
 * @property string $uuid
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Unit\Member $member
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Teamspeak whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Teamspeak whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Teamspeak whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Teamspeak whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Teamspeak whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Teamspeak whereUuid($value)
 * @mixin \Eloquent
 */
class Teamspeak extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }
}
