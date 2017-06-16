<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\TeamVideo
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $youtube_url
 * @property string $youtube_id
 * @property int $viewer_count
 * @property string $thumbnail
 * @property \Carbon\Carbon $posted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $creator
 * @property-read \App\Models\Unit\Team $team
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo wherePostedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereThumbnail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereViewerCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereYoutubeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\TeamVideo whereYoutubeUrl($value)
 * @mixin \Eloquent
 */
class TeamVideo extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $dates = ['posted_at','created_at','updated_at'];

    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
