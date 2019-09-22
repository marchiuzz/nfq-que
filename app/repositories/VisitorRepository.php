<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as DB;

class VisitorRepository
{

    public function visitorsWithoutFinish($maxVisitorsToShow = 10){
        $visitors = Visitor::doesnthave('finishedVisitor')->limit($maxVisitorsToShow)->get();
        return $visitors;
    }
}