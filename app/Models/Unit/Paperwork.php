<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paperwork
 * @package App\Models\Unit
 */
class Paperwork extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['processor_id','type','paperwork','status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processor()
    {
        return $this->belongsTo('App\Models\Unit\Member','processor_id');
    }

    /**
     * @return mixed
     */
    public function getPaperwork()
    {
        return json_decode($this->paperwork);
    }

    /**
     * @return string
     */
    public function getType()
    {
        switch ($this->type){
            case 'discharge':
                return 'Discharge Form';
                break;
            case 'file-correction':
                return 'File Correction Form';
                break;
            case 'bad-conduct':
                return 'Bad Conduct Form';
                break;
            case 'leave':
                return 'Member File Correction Form';
                break;
            case 'program-completion':
                return 'Program Completion Form';
                break;
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        switch ($this->status){
            case 1:
                return '<span class="label label-info">PENDING REVIEW</span>';
                break;
            case 2:
                return '<span class="label label-info">REVIEWED</span>';
                break;
        }
    }

}
