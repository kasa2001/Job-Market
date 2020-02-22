<?php


namespace App\Model\Entity;


class Role
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $roleName;

    public function __set($name, $value)
    {
        switch ($name) {
            case "role_name":
                $this->roleName = $value;
                break;
            default:
                $this->$name = $value;
        }
    }
}