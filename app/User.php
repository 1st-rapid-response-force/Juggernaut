<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;
    use Messagable;

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
