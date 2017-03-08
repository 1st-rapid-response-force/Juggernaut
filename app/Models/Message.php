<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Message extends \Cmgmyr\Messenger\Models\Message implements HasMedia
{
    use HasMediaTrait;



}


