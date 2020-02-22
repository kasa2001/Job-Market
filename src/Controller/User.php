<?php


namespace App\Controller;


use App\Model\IModel;
use App\Service\DatabaseService;
use App\Service\RoleService;
use App\Service\SessionService;
use App\Service\UserService;
use App\Service\ViewService;
use BlackFramework\Routing\Container\WebContainer;
use BlackFramework\Routing\Exception\Forbidden;
use BlackFramework\Routing\Exception\NotFound;
use BlackFramework\Routing\Exception\RouterException;

class User
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
     * @var SessionService
     */
    private $sessionService;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var IModel
     */
    private $model;

    /**
     * @param ViewService $viewService
     * @param UserService $userService
     * @param DatabaseService $databaseService
     * @param SessionService $sessionService
     * @param RoleService $roleService
     * @param IModel $model
     */
    public function __construct(
        ViewService $viewService,
        UserService $userService,
        DatabaseService $databaseService,
        SessionService $sessionService,
        RoleService $roleService,
        IModel $model
    )
    {
        $this->viewService = $viewService;
        $this->userService = $userService;
        $this->userService->setDatabaseService($databaseService);
        $this->roleService = $roleService;
        $this->roleService->setDatabaseService($databaseService);
        $this->sessionService = $sessionService;
        $this->model = $model;
    }

    /**
     * @path "/login"
     * @requestMethod GET
     * @return string
     */
    public function login()
    {
        if ($this->sessionService->getUser()) {
            echo "po co tutaj wlazłeś...";
        }

        $this->model->view = "User/login";
        $this->model->title = "Zaloguj się";
        return $this->viewService->renderView($this->model);
    }

    /**
     * @path "/login"
     * @requestMethod POST
     * @param $container WebContainer
     * @return string
     */
    public function loginAction(WebContainer $container)
    {
        $query = $container->getQuery();
        $user = new \App\Model\Entity\User();
        $user->login = $query->getElement('login');
        $user->password = md5($query->getElement('password'));

        if ($this->userService->logIn(
            $user
        )) {
            return "redirect://";
        }

        $this->model->view = "User/login";
        $this->model->title = "Zaloguj się";
        $this->model->errorMessage = "Użytkownik nie istnieje lub zostało podane złe hasło";

        return $this->viewService->renderView($this->model);
    }

    /**
     * @return string
     */
    public function registry()
    {
        $this->model->view = "User/registry";
        $this->model->title = "Zarejestruj się";
        $this->model->user = new \App\Model\Entity\User();
        return $this->viewService->renderView($this->model);
    }

    /**
     * @param WebContainer $container
     * @return string
     */
    public function registryAction(WebContainer $container)
    {
        $query = $container->getQuery();
        $user = new \App\Model\Entity\User();
        $user->login = $query->getElement('login');
        $user->password = $query->getElement('password');
        $user->firstName = $query->getElement('first_name');
        $user->lastName = $query->getElement('last_name');

        if (($array = $this->userService->valid($user)) === true) {
            $this->userService->registerUser(
                $user
            );
            return "redirect://login";
        }

        $user->password = null;
        $this->model->errorMessage = $array;
        $this->model->view = "User/registry";
        $this->model->title = "Zarejestruj się";
        $this->model->user = $user;

        return $this->viewService->renderView($this->model);
    }

    /**
     * @param WebContainer $container
     * @return string
     * @throws RouterException
     */
    public function showProfile(WebContainer $container)
    {
        $segment = $container->getSegment()->getPart();
        $this->model->user = $this->userService->getUser($segment[1]);

        if ($this->model->user == null) {
            throw new NotFound();
        }

        $user = $this->sessionService->getUser();

        if ($user->id != $this->model->user->id && !$this->userService->hasRole(
            $user,
            $this->roleService->getRole("ROLE_ADMIN")
        )) {
            throw new Forbidden();
        }

        $this->model->title = "Profil użytkownika " . $this->model->user->firstName . " " . $this->model->user->lastName;
        $this->model->view = "User/profile";
        return $this->viewService->renderView($this->model);
    }

    /**
     * @return string
     */
    public function logout()
    {
        $this->userService->logOut();
        return "redirect://";
    }
}