<?php

class adminController extends Controller {
    public function index()
    {
        $visitors = Visitor::orderByDesc('created_at')->get();
        $this->view('admin/index', ['waitingVisitors' => $visitors]);
    }

    public function storeVisitorToArchive($visitorId = 0)
    {
        $visitorId = (int)$visitorId;
        if($visitorId > 0){

            $visitor = Visitor::find($visitorId);

            var_dump($visitor->finishedVisitor()->attach($visitorId));
            die();

//            $visitor->finishedVisitors()->attach($visitorId);
        }

    }
}