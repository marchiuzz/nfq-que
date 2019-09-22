<?php
declare(strict_types=1);

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinishedVisitor extends Eloquent
{
    protected $table = "visitors_finished";

    protected $fillable = [
        'visitor_id',
    ];

    /**
     * @return BelongsTo
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}