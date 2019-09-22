<?php
declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    private $visitorRepository;

    public function __construct()
    {
        $this->visitorRepository = new VisitorRepository();
    }

    public function index(): void
    {
        $this->view('admin/index', ['visitors' => $this->visitorRepository->waitingVisitors(1)]);
    }

    public function storeVisitorToArchive($visitorId = 0): void
    {
        $visitorId = (int)$visitorId;
        if ($visitorId > 0) {
            $finishVisitor = $this->visitorRepository->finishVisitor($visitorId);
            $this->visitorRepository->addVisitorTimesToLog($finishVisitor['visitor'], $finishVisitor['finishedVisitor']);

            $timeDiff = $finishVisitor['finishedVisitor']->created_at->diffInSeconds($finishVisitor['visitor']->created_at);
            $formattedTimeDiff = Helper::TimeText($timeDiff);

            $this->view('admin/index', ['visitors' => $this->visitorRepository->waitingVisitors(1), 'finishedInSeconds' => $formattedTimeDiff]);
        }
    }
}