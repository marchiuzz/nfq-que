<?php
declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class visitorController
 */
class visitorController extends Controller
{
    private $visitorRepository;
    public function __construct()
    {
        $this->visitorRepository = new VisitorRepository();
    }

    public function index($maxVisitorsToShow = 10)
    {
        $visitors = $this->visitorRepository->waitingVisitors(10);
        $averageWaitingTime = $this->averageVisitorWaitingTimeInSecs();
        $formattedAverageWaitingTime = Helper::TimeText($averageWaitingTime);
        $this->view('visitor/index', ['visitors' => $visitors, 'formattedAverageWaitingTime' => $formattedAverageWaitingTime]);
    }


    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visitor_name']) && !empty($_POST['visitor_name'])){
            $this->visitorRepository->saveNewVisitorToQue($_POST['visitor_name']);
            $this->index();
            return false;
        }

        $this->view('visitor/create');
    }

    public function averageVisitorWaitingTimeInSecs(): float
    {
        $waitingTimesDiffInSeconds = $this->visitorRepository->getWaitingTimeDifference();
        $a = array_filter($waitingTimesDiffInSeconds);
        $average = count($a) < 1 ? 0 : array_sum($a)/count($a);

        return $average;
    }


}