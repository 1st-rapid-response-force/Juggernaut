<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\ProgramNote
 *
 * @property int $id
 * @property int $author_id
 * @property int $member_id
 * @property int $program_id
 * @property string $note
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Unit\Member $author
 * @property-read \App\Models\Unit\Member $member
 * @property-read \App\Models\Unit\Program $program
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramNote whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramNote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramNote whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramNote whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramNote whereProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramNote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProgramNote extends Model
{
    protected $fillable = ['note'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Unit\Program');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Unit\Member','author_id');
    }
}
