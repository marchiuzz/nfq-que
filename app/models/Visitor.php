<?php
declare(strict_types=1);

use Illuminate\Database\Eloquent\Model as Eloquent;

class Visitor extends Eloquent
{
    protected $fillable = [
        'name'
    ];
}