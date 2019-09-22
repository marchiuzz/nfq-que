<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class TimesLog extends Eloquent
{
    protected $table = "times_log";
    public $timestamps = [];

    protected $fillable = [
        'started',
        'finished'
    ];
}