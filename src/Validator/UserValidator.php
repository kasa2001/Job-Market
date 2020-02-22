<?php


namespace App\Validator;


use App\Model\Entity\User;
use App\Service\DatabaseService;

class UserValidator
{

    /**
     * @var DatabaseService
     */
    private $databaseService;

    public function __construct(DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    /**
     * @param User $user
     * @return array
     */
    public function registryValidate(User $user)
    {
        $array = [];
        if (!preg_match("/^[A-Z][a-z]+$/u", $user->firstName)) {
            $array['first_name'] = "Wrong name";
        }

        if (!preg_match("/^[A-Z][a-z]+$/u", $user->firstName)) {
            $array['last_name'] = "Wrong surname";
        }

        if (!preg_match("/^[A-Z][a-z]+$/u", $user->login)) {
            $array['login'] = "Wrong login";
        }

        if ($this->databaseService->findUserByLogin($user)) {
            $array['login'] = "Login is registered. Please change login";
        }

        if (!preg_match("/^[a-z\d]{6,}$/ui", $user->password)) {
            $array['password'] = "Wrong password";
        }

        return $array;
    }
}