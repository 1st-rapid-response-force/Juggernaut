<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rank
 *
 * @package App\Models\Unit
 * @property int $id
 * @property string $name
 * @property string $abbreviation
 * @property int $sort_order
 * @property int $teamspeak_id
 * @property int $tis
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereAbbreviation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereSortOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereTeamspeakId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereTis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Rank whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rank extends Model
{
    /**
     * Array of guarded columns
     * @var array
     */
    protected $guarded = ['id'];
}
