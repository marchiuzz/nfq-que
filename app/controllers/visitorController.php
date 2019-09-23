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
        $this->view('visitor/create');
    }

    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visitor_name']) && !empty($_POST['visitor_name'])){
            $name = $_POST['visitor_name'];

            $error = [];
            if($name == ""){
                $error[] = "Fill your anme";
            }

            $nameWithoutSpaces = str_replace(' ', '', $name);
            if(!(preg_match('/^\p{L}+$/u', $nameWithoutSpaces))){
                $error[] = "Your name has to be only letters";
            }

            if(strlen($name) < 4){
                $error[] = "You have to input your full real name";
            }

            if(count($error) > 0){
                $this->view('visitor/create', ['errors' => $error, 'visitorName' => $name]);
            } else {
                $this->visitorRepository->saveNewVisitorToQue($name);
                $this->index();

            }
            return false;
        }
    }

    public function averageVisitorWaitingTimeInSecs(): float
    {
        $waitingTimesDiffInSeconds = $this->visitorRepository->getWaitingTimeDifference();
        $a = array_filter($waitingTimesDiffInSeconds);
        $average = count($a) < 1 ? 0 : array_sum($a)/count($a);

        return $average;
    }


}