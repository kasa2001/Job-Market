<?php


namespace App\Service;


use App\Model\Entity\Category;

class CategoryService
{

    /**
     * @var DatabaseService
     */
    private $databaseService;

    public function getCategoryByName(string $categoryName) : Category
    {
        return $this->databaseService->getCategoryByName($categoryName);
    }

    /**
     * @param DatabaseService $databaseService
     */
    public function setDatabaseService(DatabaseService $databaseService): void
    {
        $this->databaseService = $databaseService;
    }


    /**
     * @return Category[]
     */
    public function getAllCategory(): array
    {
        return $this->databaseService->getAllCategories();
    }


}