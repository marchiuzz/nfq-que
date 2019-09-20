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
        $this->view('home/index');
    }
}