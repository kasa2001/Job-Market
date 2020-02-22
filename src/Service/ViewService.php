<?php


namespace App\Service;


use App\Model\Entity\User;
use App\Model\IModel;

class ViewService
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var SessionService
     */
    private $sessionService;

    public function __construct()
    {
        $this->user = new User();
        $this->sessionService = new SessionService();
    }

    public function renderView(IModel $model): string
    {
        ob_start();
        include APPLICATION_PATH ."/src/View/layout/layout.php";
        return ob_get_clean();
    }

    public function requireTemplate(string $templateName, IModel $model)
    {
        include APPLICATION_PATH ."/src/View/" . $templateName . ".php";
    }

    public function isLogged()
    {
        $user = $this->sessionService->getUser();
        return $user != null;
    }

    public function getLoggedUser()
    {
        return $this->sessionService->getUser();
    }

    public function hasRole($roleName)
    {
        return true;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}