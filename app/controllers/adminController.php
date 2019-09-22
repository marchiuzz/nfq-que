<?php

class adminController extends Controller {
    public function index()
    {
        $visitors = Visitor::doesnthave('finishedVisitor')->orderBy('created_at')->get();
        $this->view('admin/index', ['visitors' => $visitors]);
    }

    public function storeVisitorToArchive($visitorId = 0)
    {
        $visitorId = (int)$visitorId;
        if($visitorId > 0){
            $visitor = Visitor::find($visitorId);
            $finishedVisitor = new FinishedVisitor();

            $visitor->finishedVisitor()->save($finishedVisitor);

            $this->index();
        }

    }
}