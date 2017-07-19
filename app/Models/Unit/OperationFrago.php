<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class OperationFrago extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = "operations_frago";

    protected $fillable = ['message'];

    public function operation()
    {
        return $this->belongsTo('App\Models\Unit\Operation');
    }
}
