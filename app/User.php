<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;
use Cog\Ban\Contracts\HasBans as HasBansContract;
use Cog\Ban\Traits\HasBans;

/**
 * Class User
 *
 * @package App
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $steam_id
 * @property string $timezone
 * @property bool $admin
 * @property string $signature
 * @property bool $board_member
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Announcement[] $announcement
 * @property-read \App\Models\Application $application
 * @property-read \App\Models\Unit\Member $member
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Participant[] $participants
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Thread[] $threads
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\TeamVideo[] $videos
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBoardMember($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSignature($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSteamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTimezone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasBansContract
{
    use Notifiable;
    use Messagable;
    use HasBans;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','steam_id', 'email', 'password', 'timezone','signature','admin','board_member'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function name()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne('App\Models\Unit\Member');
    }

    public function announcement()
    {
        return $this->hasMany('App\Models\Unit\Announcement');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\Unit\TeamVideo');
    }

    public function application()
    {
        return $this->hasOne('App\Models\Application');
    }

}
