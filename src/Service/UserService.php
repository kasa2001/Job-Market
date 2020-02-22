<?php


namespace App\Service;

use App\Model\Entity\Role;
use App\Model\Entity\User;
use App\Validator\UserValidator;

class UserService
{
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * @var DatabaseService
     */
    private $databaseService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    /**
     * Login action
     * @param User $user
     * @return bool
     */
    public function logIn(User $user)
    {
        $completedUser = $this->databaseService->verifyUser($user);
        $user->password = null;// Zabezpieczenie przed niepotrzebnym wysłaniem hasła w 2 stronę.
        return $completedUser ? $this->sessionService->saveToSession($completedUser, 'user') : false;
    }

    /**
     * Logout action
     */
    public function logOut()
    {
        $this->sessionService->destroySession();
    }

    /**
     * Register new user
     * @param User $user
     * @return bool
     */
    public function registerUser(User $user)
    {
        $user->password = md5($user->password);
        return $this->databaseService->registerUser($user);
    }

    /**
     * Valid user
     * @param User $user
     * @return array|bool
     */
    public function valid(User $user)
    {
        $validator = new UserValidator(
            $this->databaseService
        );
        $array = $validator->registryValidate($user);
        return empty($array) ? true : $array;
    }

    public function getUser(int $id)
    {
        return $this->databaseService->getUserById($id);
    }

    public function hasRole(User $user, Role $role)
    {
        return $this->databaseService->hasRole($user, $role);
    }


    public function setDatabaseService(DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    public function getAllUsers()
    {
        return $this->databaseService->getAllUsers();
    }

    public function deleteUser(int $id)
    {
        return $this->databaseService->removeUser($id);
    }

    public function addRole(User $user, Role $role)
    {
        return $this->databaseService->addRole(
            $user,
            $role
        );
    }
}