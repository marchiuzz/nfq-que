<?php
declare(strict_types=1);

use Illuminate\Database\Eloquent\Builder as Builder;

/**
 * Class visitorController
 */
class visitorController extends Controller
{

    public function index($maxVisitorsToShow = 10)
    {
        $visitors = Visitor::doesnthave('finishedVisitor')->limit($maxVisitorsToShow)->get();
        $this->view('visitor/index', ['visitors' => $visitors]);
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


}