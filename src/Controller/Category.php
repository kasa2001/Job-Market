<?php


namespace App\Controller;


use App\Model\IModel;
use App\Service\CategoryService;
use App\Service\DatabaseService;
use App\Service\OfferService;
use App\Service\ViewService;
use BlackFramework\Routing\Container\WebContainer;
use BlackFramework\Routing\Exception\NotFound;

class Category
{

    /**
     * @var ViewService
     */
    private $viewService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var OfferService
     */
    private $offerService;

    /**
     * @var IModel
     */
    private $model;

    public function __construct(
        ViewService $viewService,
        CategoryService $categoryService,
        DatabaseService $databaseService,
        OfferService $offerService,
        IModel $model
    )
    {
        $this->viewService = $viewService;
        $this->categoryService = $categoryService;
        $this->categoryService->setDatabaseService($databaseService);
        $this->offerService = $offerService;
        $this->offerService->setDatabaseService($databaseService);
        $this->model = $model;
    }

    public function showList(WebContainer $container)
    {
        $segment = $container->getSegment()->getPart();
        $query = $container->getQuery();

        $category = $this->categoryService->getCategoryByName($segment[count($segment) - 1]);

        if (!$category) {
            throw new NotFound();
        }


        if (($description = $query->getElement('description')) != null) {
            $this->model->list = $this->offerService->findOfferByCategoryAndDescription(
                $category,
                $description
            );
        } else {
            $this->model->list = $this->offerService->findOfferByCategory(
                $category
            );
        }


        $this->model->title = "Lista ofert w kategorii";
        $this->model->view = "Offer/list";
        $this->model->categoryList = $this->categoryService->getAllCategory();

        return $this->viewService->renderView(
            $this->model
        );
    }
}