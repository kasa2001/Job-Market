<?php


namespace App\Service;


use App\Model\Entity\Category;
use App\Model\Entity\Offer;
use App\Model\Entity\User;

class OfferService
{

    /**
     * @var DatabaseService
     */
    private $databaseService;

    /**
     * @return Offer[]
     */
    public function getAllOffers()
    {
        return $this->databaseService->findAllActiveOffers();
    }

    /**
     * @param Offer $offer
     * @param User $user
     * @param array $skills
     * @return bool
     */
    public function saveOffer(Offer $offer, User $user, array $skills)
    {
        return $this->databaseService->saveOffer(
            $offer,
            $user,
            $skills
        );
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOffer(int $id)
    {
        return $this->databaseService->getOfferById(
            $id
        );
    }

    public function setDatabaseService(DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    public function activeOffer(int $id)
    {
        return $this->databaseService->toggleActivation($id);
    }

    public function findOfferByCategory(Category $category)
    {
        return $this->databaseService->findActiveOffersByCategory(
            $category
        );
    }

    public function getAllOffersByDescription(string $description)
    {
        return $this->databaseService->findActiveOffersByDescription(
            $description
        );
    }

    public function findOfferByCategoryAndDescription(Category $category, string $description)
    {
        return $this->databaseService->findActiveOffersByCategoryAndDescription(
            $category,
            $description
        );
    }
}