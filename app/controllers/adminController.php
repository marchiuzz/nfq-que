<?php
declare(strict_types=1);


use Illuminate\Support\Facades\DB;

class adminController extends Controller {

    public function index(): void
    {
        $visitors = Visitor::doesnthave('finishedVisitor')->limit(1)->orderBy('created_at')->get();
        $this->view('admin/index', ['visitors' => $visitors]);
    }

    public function storeVisitorToArchive($visitorId = 0): void
    {
        $visitorId = (int)$visitorId;
        if($visitorId > 0){
            $visitor = Visitor::find($visitorId);
            $finishedVisitor = new FinishedVisitor();
            $finishedVisitor = $visitor->finishedVisitor()->save($finishedVisitor);

            $log = new TimesLog();
            $log->started = $visitor->created_at;
            $log->finished = $finishedVisitor->created_at;
            $log->save();

            $this->index();
        }

    }
}