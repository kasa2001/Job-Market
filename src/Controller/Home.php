<?php


namespace App\Controller;


use App\Model\IModel;
use App\Service\ViewService;

class Home
{
    private $viewService;

    private $model;

    public function __construct(ViewService $viewService, IModel $model)
    {
        $this->viewService = $viewService;
        $this->model = $model;
    }

    public function index()
    {
        $this->model->view = "Home/index";
        $this->model->title = "Strona główna";
        return $this->viewService->renderView($this->model);
    }
}