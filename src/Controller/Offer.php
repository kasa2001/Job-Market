<?php


namespace App\Controller;


use App\Model\IModel;
use App\Service\CategoryService;
use App\Service\DatabaseService;
use App\Service\OfferService;
use App\Service\RoleService;
use App\Service\SessionService;
use App\Service\SkillService;
use App\Service\UserService;
use App\Service\ViewService;
use BlackFramework\Routing\Container\WebContainer;
use BlackFramework\Routing\Exception\Forbidden;

class Offer
{

    /**
     * @var ViewService
     */
    private $viewService;

    /**
     * @var OfferService
     */
    private $offerService;

    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var SkillService
     */
    private $skillService;

    /**
     * @var IModel
     */
    private $model;

    public function __construct(
        ViewService $viewService,
        OfferService $offerService,
        DatabaseService $databaseService,
        SessionService $sessionService,
        UserService $userService,
        RoleService $roleService,
        CategoryService $categoryService,
        SkillService $skillService,
        IModel $model
    )
    {
        $this->viewService = $viewService;
        $this->offerService = $offerService;
        $this->offerService->setDatabaseService($databaseService);
        $this->sessionService = $sessionService;
        $this->userService = $userService;
        $this->userService->setDatabaseService($databaseService);
        $this->roleService = $roleService;
        $this->roleService->setDatabaseService($databaseService);
        $this->categoryService = $categoryService;
        $this->categoryService->setDatabaseService($databaseService);
        $this->skillService = $skillService;
        $this->skillService->setDatabaseService($databaseService);
        $this->model = $model;
    }

    public function offerList(WebContainer $container)
    {
        $query = $container->getQuery();
        $this->model->title = "Lista ofert";
        $this->model->view = "Offer/list";
        if (($description = $query->getElement('description')) != null) {
            $this->model->list = $this->offerService->getAllOffersByDescription(
                $description
            );
        } else {
            $this->model->list = $this->offerService->getAllOffers();
        }


        $this->model->categoryList = $this->categoryService->getAllCategory();

        return $this->viewService->renderView(
            $this->model
        );
    }

    public function offerAdd()
    {
        $this->model->title = "Dodaj ofertę";
        $this->model->view = "Offer/add";
        $this->model->categoryList = $this->categoryService->getAllCategory();
        $this->model->skillList = $this->skillService->getSkills();

        return $this->viewService->renderView(
            $this->model
        );
    }

    public function offerAddAction(WebContainer $container)
    {
        $query = $container->getQuery();

        $offer = new \App\Model\Entity\Offer();
        $user = $this->sessionService->getUser();
        $offer->description = $query->getElement('description');
        $offer->categoryId = $query->getElement('category_id');
        $skills = $query->getElement('skills');
        $offer->active = true;
        if ($this->offerService->saveOffer(
            $offer,
            $user,
            $skills
        )) {
            return "redirect://listOffer";
        }

        $this->model->title = "Dodaj ofertę";
        $this->model->view = "Offer/add";
        $this->model->categoryList = $this->categoryService->getAllCategory();
        $this->model->skillList = $this->skillService->getSkills();

        return $this->viewService->renderView(
            $this->model
        );
    }

    public function showOffer(WebContainer $container)
    {
        $segment = $container->getSegment()->getPart();

        $user = $this->sessionService->getUser();
        $offer = $this->offerService->findOffer(
            $segment[count($segment) - 1]
        );

        if ($user->id != $offer->userId && !$this->userService->hasRole(
                $user,
                $this->roleService->getRole(
                    'ROLE_ADMIN'
                )
            )
        ) {
            throw new Forbidden();
        }

        $this->model->title = "Oferta";
        $this->model->view = "Offer/details";
        $this->model->offer = $offer;
        $this->model->skillList = $this->skillService->getSkillFromOffer(
            $offer
        );
        return $this->viewService->renderView(
            $this->model
        );

    }
}