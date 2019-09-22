<?php
declare(strict_types=1);

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visitor extends Eloquent
{

    protected $fillable = [
        'name'
    ];


   
    public function finishedVisitor()
    {
        return $this->hasOne(FinishedVisitor::class);
    }
}