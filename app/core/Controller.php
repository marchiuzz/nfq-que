<?php
declare(strict_types=1);

class Controller
{
    public function model($model)
    {
        require_once '../app/models/'.$model.'.php';
        return new $model();
    }

    public function view($view, $data='')
    {
        require_once '../app/views/partials/header.php';
        require_once '../app/views/'.$view.'.php';
        require_once '../app/views/partials/footer.php';
    }
}