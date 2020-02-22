<?php


namespace App\Repository;

use App\Model\Entity\Category;
use PDO;

class CategoryRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var string
     */
    private $table = "category";

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $statement = $this->pdo->prepare("select * from {$this->table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Category::class);
    }

    public function findByName(string $categoryName)
    {
        $statement = $this->pdo->prepare("select id, name from {$this->table} where name = :name");
        $statement->execute(
            [
                'name' => $categoryName
            ]
        );

        return $statement->fetchObject(Category::class);
    }
}