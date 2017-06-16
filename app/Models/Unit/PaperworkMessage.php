<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\PaperworkMessage
 *
 * @property int $id
 * @property int $member_id
 * @property int $paperwork_id
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Unit\Member $member
 * @property-read \App\Models\Unit\Paperwork $paperwork
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PaperworkMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PaperworkMessage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PaperworkMessage whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PaperworkMessage whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PaperworkMessage wherePaperworkId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PaperworkMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaperworkMessage extends Model
{
    protected $fillable = ['message'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }

    public function paperwork()
    {
        return $this->belongsTo('App\Models\Unit\Paperwork');
    }
}
