<?php


namespace App\Service;


use App\Model\Entity\User;
use App\Model\IModel;

class SessionService
{

    public function saveToSession(IModel $model, $key)
    {
        $_SESSION[$key] = $model;
        return true;
    }

    public function destroySession()
    {
        session_destroy();
    }

    public function getUser()
    {
        return $_SESSION['user'] ?? null;
    }
}