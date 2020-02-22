<?php


namespace App\Model\Entity;


use App\Model\IModel;

class Offer implements IModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $description;

    /**
     * @var boolean
     */
    public $active;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var int
     */
    public $categoryId;

    public function __set($name, $value)
    {
        switch ($name) {
            case "user_id":
                $this->userId = $value;
                break;
            case "category_id":
                $this->categoryId = $value;
                break;
            default:
                $this->$name = $value;
        }
    }

}