<?php


namespace App\Controller;


use App\Model\IModel;
use App\Service\DatabaseService;
use App\Service\OfferService;
use App\Service\RoleService;
use App\Service\SessionService;
use App\Service\UserService;
use App\Service\ViewService;
use BlackFramework\Routing\Container\WebContainer;
use BlackFramework\Routing\Exception\BadRequest;
use BlackFramework\Routing\Exception\Forbidden;
use BlackFramework\Routing\Exception\NotFound;

class Admin
{
    /**
     * @var ViewService
     */
    private $viewService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var SessionService
     */
    private $sessionService;

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
        UserService $userService,
        DatabaseService $databaseService,
        RoleService $roleService,
        SessionService $sessionService,
        OfferService $offerService,
        IModel $model
    )
    {
        $this->viewService = $viewService;
        $this->userService = $userService;
        $this->userService->setDatabaseService($databaseService);
        $this->roleService = $roleService;
        $this->roleService->setDatabaseService($databaseService);
        $this->sessionService = $sessionService;
        $this->offerService = $offerService;
        $this->offerService->setDatabaseService($databaseService);
        $this->model = $model;
    }

    public function listUsers()
    {
        $user = $this->sessionService->getUser();

        if (!$user || !$this->userService->hasRole(
                $user,
                $this->roleService->getRole("ROLE_ADMIN")
            )) {
            throw new Forbidden();
        }

        $this->model->users = $this->userService->getAllUsers();
        $this->model->title = "Lista użytkowników";
        $this->model->view = "Admin/list";

        return $this->viewService->renderView(
            $this->model
        );
    }

    public function deleteUser(WebContainer $container)
    {
        $segment = $container->getSegment()->getPart();

        if (
            $this->userService->deleteUser($segment[count($segment) - 1])
        ) {
            return "nocontent:/";
        }

        throw new NotFound();
    }

    /**
     * @param WebContainer $container
     * @return string
     * @throws BadRequest
     * @throws NotFound
     */
    public function connectWithRole(WebContainer $container)
    {
        $query = $container->getQuery();

        $role = $this->roleService->getRole(
            $query->getElement('role_name')
        );

        $user = $this->userService->getUser(
            $query->getElement('user_id')
        );

        if ($this->userService->hasRole(
            $user,
            $role
        )) {
            throw new BadRequest();
        }

        if ($this->userService->addRole(
            $user,
            $role
        )) {
            return "nocontent:/";
        }

        throw new NotFound();
    }

    public function activate(WebContainer $container)
    {
        $segment = $container->getSegment()->getPart();
        if ($this->offerService->activeOffer($segment[count($segment) - 1])) {
            return "nocontent:/";
        }

        throw new NotFound();
    }

}