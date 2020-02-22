<?php


namespace App\Repository;

use App\Model\Entity\Category;
use App\Model\Entity\Offer;
use App\Model\Entity\User;
use PDO;

class OfferRepository
{

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var string
     */
    private $table = "public.offer";

    private $connection = "public.offer_skill";

    /**
     * @param $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array
     */
    public function findAllActiveTrue()
    {
        $statement = $this->pdo->prepare("select id, description, active from {$this->table} where active = true");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Offer::class);
    }

    /**
     * @param int $id
     * @return Offer
     */
    public function findById(int $id)
    {
        $statement = $this->pdo->prepare("select id, description, active, user_id from {$this->table} where id = :id");
        $statement->execute(
            [
                'id' => $id
            ]
        );

        return $statement->fetchObject(Offer::class);
    }

    /**
     * @param Offer $offer
     * @param User $user
     * @param array $skills
     * @return bool
     */
    public function save(Offer $offer, User $user, array $skills)
    {
        $this->pdo->beginTransaction();
        $statement = $this->pdo->prepare("insert into {$this->table} (description, active, user_id, category_id) values (:description, :active, :user_id, :category_id) RETURNING id");
        $connection = $this->pdo->prepare("insert into {$this->connection} (offer_id, skill_id) values (:offer_id, :skill_id)");

        $insert =  $statement->execute(
            [
                'description' => $offer->description,
                'active' => $offer->active,
                'user_id' => $user->id,
                'category_id' => $offer->categoryId
            ]
        );

        if (!$insert) {
            $this->pdo->rollBack();
            return false;
        }

        $offerId = $statement->fetch()['id'];

        foreach ($skills as $skill) {
            if (!$connection->execute(
                [
                    'offer_id' => $offerId,
                    'skill_id' => $skill
                ]
            )) {
                $this->pdo->rollBack();
                return false;
            }
        }


        $this->pdo->commit();
        return true;
    }

    public function toggleActivation(int $id)
    {
        $statement = $this->pdo->prepare("update {$this->table} set active = not active where id = :id");

        return $statement->execute(
            [
                'id' => $id
            ]
        );
    }

    public function findAllByCategoryAndActiveTrue(Category $category)
    {
        $statement = $this->pdo->prepare("select id, description, active from {$this->table} where category_id = :category_id and active = true");
        $statement->execute(
            [
                'category_id' => $category->id,
            ]
        );

        return $statement->fetchAll(PDO::FETCH_CLASS, Offer::class);
    }

    public function findActiveOffersByDescription(string $description)
    {
        $statement = $this->pdo->prepare("select id, description, active, user_id from {$this->table} where description ilike :description and active = true");

        $statement->execute(
            [
                'description' => '%' . $description . '%'
            ]
        );

        return $statement->fetchAll(PDO::FETCH_CLASS, Offer::class);
    }

    public function findActiveOffersByCategoryAndDescription(Category $category, string $description)
    {
        $statement = $this->pdo->prepare("select id, description, active, user_id from {$this->table} where category_id = :category_id and description ilike :description and active = true");

        $statement->execute(
            [
                'category_id' => $category->id,
                'description' => '%' . $description . '%'
            ]
        );

        return $statement->fetchAll(PDO::FETCH_CLASS, Offer::class);
    }
}