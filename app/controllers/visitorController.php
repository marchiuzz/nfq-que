<?php
declare(strict_types=1);

/**
 * Class visitorController
 */
class visitorController extends Controller
{

    public function index()
    {
        $visitors = Visitor::orderByDesc('created_at')->get();
        $this->view('visitor/index', ['visitors' => $visitors]);
    }


    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visitor_name']) && !empty($_POST['visitor_name'])){
            $newVisitor = new Visitor();
            $newVisitor->name = $_POST['visitor_name'];
            $newVisitor->save();
            $this->index();
            return false;
        }

        $this->view('visitor/create');
    }


}