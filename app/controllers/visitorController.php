<?php
declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class visitorController
 */
class visitorController extends Controller
{

    public function index($maxVisitorsToShow = 10)
    {
        $visitors = Visitor::doesnthave('finishedVisitor')->limit($maxVisitorsToShow)->get();
        $averageWaitingTime = $this->averageVisitorWaitingTimeInSecs();
        $formattedAverageWaitingTime = Helper::TimeText($averageWaitingTime);
        $this->view('visitor/index', ['visitors' => $visitors, 'formattedAverageWaitingTime' => $formattedAverageWaitingTime]);
    }



    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visitor_name']) && !empty($_POST['visitor_name'])){
            $newVisitor = new Visitor();
            $newVisitor->name = $_POST['visitor_name'];
            $newVisitor->ip = Helper::GetIp();
            $newVisitor->save();
            $this->index();
            return false;
        }

        $this->view('visitor/create');
    }

    private function waitingTimesDifference(): array
    {
        $sql = "TIMESTAMPDIFF(SECOND,started,finished) as seconds";
        $waitingTimesDiffInSeconds = TimesLog::select(DB::raw($sql))->pluck('seconds')->toArray();

        return $waitingTimesDiffInSeconds;
    }

    public function averageVisitorWaitingTimeInSecs(): float
    {
        $waitingTimesDiffInSeconds = $this->waitingTimesDifference();
        $a = array_filter($waitingTimesDiffInSeconds);
        $average = array_sum($a)/count($a);

        return $average;
    }


}