<?php

class adminController extends Controller {
    public function index()
    {
        $visitors = Visitor::orderByDesc('created_at')->get();
        $this->view('admin/index', ['waitingVisitors' => $visitors]);
    }

    public function storeNewVisitor($visitorId = "")
    {
        echo $visitorId;
        die();
    }
}