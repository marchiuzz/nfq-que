<?php
declare(strict_types=1);

/**
 * Class homeController
 */
class homeController extends Controller
{
    /**
     * @param string $name
     */
    public function index($name = '')
    {
        $visitor = Visitor::find(1);

        echo ($visitor->finishedVisitor->pluck('visitor_id'));

        die();
        $this->view('home/index', ['finishedVisitors' => $finishedVisitors]);
    }
}