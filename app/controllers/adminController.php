<?php
declare(strict_types=1);

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
        $visitors = $this->visitorRepository->waitingVisitors(1);
        $this->view('admin/index', ['visitors' => $visitors]);
    }

    public function storeVisitorToArchive($visitorId = 0): void
    {
        $visitorId = (int)$visitorId;
        if ($visitorId > 0) {
            $finishVisitor = $this->visitorRepository->finishVisitor($visitorId);
            $this->visitorRepository->addVisitorTimesToLog($finishVisitor['visitor'], $finishVisitor['finishedVisitor']);
            $this->index();
        }

    }
}