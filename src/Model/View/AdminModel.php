<?php


namespace App\Model\View;


use App\Model\Entity\User;
use App\Model\IModel;

class AdminModel implements IModel
{
    /**
     * @var User[]
     */
    public $users;
}