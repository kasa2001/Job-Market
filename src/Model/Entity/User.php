<?php


namespace App\Model\Entity;

use App\Model\IModel;

class User implements IModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var boolean
     */
    public $active;

    public function __set($name, $value)
    {
        switch ($name) {
            case "first_name":
                $this->firstName = $value;
                break;
            case "last_name":
            $this->lastName = $value;
                break;
            default:
                $this->$name = $value;
        }
    }
}