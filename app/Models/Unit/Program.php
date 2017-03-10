<?php

namespace App\Models\Unit;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Program extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name','description','video', 'document'];
}
