<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Participant[] $participants
 * @property-read \Cmgmyr\Messenger\Models\Thread $thread
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereUserId($value)
 * @mixin \Eloquent
 */
class Message extends \Cmgmyr\Messenger\Models\Message implements HasMedia
{
    use HasMediaTrait;

        public function getDeleteAttachment($message,$attachment_id)
        {
            if(($this->user->id == \Auth::User()->id) || \Auth::User()->admin)
            {
                return ' - <a href="'.route('inbox.edit.message.attachment.delete', [$message,$attachment_id]).'"
             data-method="delete"
             data-trans-button-cancel="Cancel"
             data-trans-button-confirm="Delete"
             data-trans-title="Are you sure?"
             class="btn btn-xs"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a> ';
            } else {
                return '';
            }



        }
}


