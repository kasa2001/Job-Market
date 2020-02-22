<?php


namespace App\Model\View;


use App\Model\Entity\User;

class UserView extends EmptyModel
{
    /**
     * @var string
     */
    public $errorMessage;

    /**
     * @var User
     */
    public $user;
}