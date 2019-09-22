<?php
declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as DB;

class visitorRepository
{
    public function waitingVisitors($maxVisitorsToShow = 10)
    {
        $visitors = Visitor::doesnthave('finishedVisitor')->limit($maxVisitorsToShow)->get();
        return $visitors;
    }

    public function saveNewVisitorToQue($visitorName)
    {
        $newVisitor = new Visitor();
        $newVisitor->name = $visitorName;
        $newVisitor->ip = Helper::GetIp();
        $newVisitor->save();
    }

    public function getWaitingTimeDifference()
    {
        $sql = "TIMESTAMPDIFF(SECOND,started,finished) as seconds";
        $waitingTimesDiffInSeconds = TimesLog::select(DB::raw($sql))->pluck('seconds')->toArray();

        return $waitingTimesDiffInSeconds;
    }

    public function finishVisitor($visitorId)
    {
        $visitor = Visitor::find($visitorId);
        $finishedVisitor = new FinishedVisitor();
        $finishedVisitor = $visitor->finishedVisitor()->save($finishedVisitor);

        return ['visitor' => $visitor, 'finishedVisitor' => $finishedVisitor];
    }

    public function addVisitorTimesToLog(Visitor $visitor, FinishedVisitor $finishedVisitor)
    {
        $log = new TimesLog();
        $log->started = $visitor->created_at;
        $log->finished = $finishedVisitor->created_at;
        $log->save();
    }
}