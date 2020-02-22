<?php


namespace App\Service;

use App\Model\Entity\Category;
use App\Model\Entity\Offer;
use App\Model\Entity\Role;
use App\Model\Entity\Skill;
use App\Model\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\OfferRepository;
use App\Repository\RoleRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use BlackFramework\Routing\Exception\NotFound;
use PDO;

use App\Config\Database;

class DatabaseService
{
    /**
     * @var Database
     */
    private $dbConfig;

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->dbConfig = new Database();
        $this->connect();
    }

    public function connect()
    {
        $this->pdo = new PDO(
            $this->dbConfig->getDns(),
            $this->dbConfig->getUser(),
            $this->dbConfig->getPassword()
        );
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function verifyUser(User $user)
    {
        $repository = new UserRepository($this->pdo);
        return $repository->findUserByLoginAndPassword($user);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function registerUser(User $user)
    {
        $repository = new UserRepository($this->pdo);
        return $repository->registerUser($user);
    }

    /**
     * @param User $user
     * @return int
     */
    public function findUserByLogin(User $user)
    {
        $repository = new UserRepository($this->pdo);
        return $repository->userExists($user);
    }

    /**
     * @param User $user
     * @param Role $role
     * @return int
     */
    public function hasRole(User $user, Role $role)
    {
        $repository = new UserRepository(
            $this->pdo
        );

        return $repository->hasRole($user, $role);
    }

    /**
     * @param string $roleName
     * @return mixed
     * @throws NotFound
     */
    public function getRole(string $roleName)
    {
        $repository = new RoleRepository(
            $this->pdo
        );

        $role = $repository->findRoleByName($roleName);

        if ($role == null) {
            throw new NotFound();
        }

        return $role;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUserById(int $id)
    {
        $repository = new UserRepository(
            $this->pdo
        );

        return $repository->findUserById($id);
    }

    /**
     * @return User[]
     */
    public function getAllUsers()
    {
        $repository = new UserRepository(
            $this->pdo
        );
        return $repository->findAll();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeUser(int $id)
    {
        $repository = new UserRepository(
            $this->pdo
        );
        return $repository->deleteUser($id);
    }

    /**
     * @return Offer[]
     */
    public function findAllActiveOffers()
    {
        $repository = new OfferRepository(
            $this->pdo
        );

        return $repository->findAllActiveTrue();
    }

    /**
     * @param Offer $offer
     * @param User $user
     * @param array $skills
     * @return bool
     */
    public function saveOffer(Offer $offer, User $user, array $skills)
    {
        $repository = new OfferRepository(
            $this->pdo
        );

        return $repository->save(
            $offer,
            $user,
            $skills
        );
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOfferById(int $id)
    {
        $repository = new OfferRepository(
            $this->pdo
        );

        return $repository->findById($id);
    }

    public function toggleActivation(int $id)
    {
        $repository = new OfferRepository(
            $this->pdo
        );

        return $repository->toggleActivation($id);
    }

    public function addRole(User $user, Role $role)
    {
        $repository = new UserRepository(
            $this->pdo
        );
        return $repository->addRoleToUser(
            $user,
            $role
        );
    }

    public function getCategoryByName(string $categoryName)
    {
        $repository = new CategoryRepository(
            $this->pdo
        );

        return $repository->findByName($categoryName);
    }

    public function findActiveOffersByCategory(Category $category)
    {
        $repository = new OfferRepository(
            $this->pdo
        );

        return $repository->findAllByCategoryAndActiveTrue($category);
    }

    public function getAllCategories()
    {
        $repository = new CategoryRepository(
            $this->pdo
        );

        return $repository->findAll();
    }

    public function getAllSkills()
    {
        $repository = new SkillRepository(
            $this->pdo
        );

        return $repository->findAll();
    }

    public function getSkillsFromOffer(Offer $offer)
    {
        $repository = new SkillRepository(
            $this->pdo
        );

        return $repository->getSelectedSkills($offer);
    }

    public function saveSkill(Skill $skill)
    {
        $repository = new SkillRepository(
            $this->pdo
        );

        return $repository->save($skill);
    }

    public function findActiveOffersByDescription(string $description)
    {
        $repository = new OfferRepository(
            $this->pdo
        );

        return $repository->findActiveOffersByDescription(
            $description
        );
    }

    public function findActiveOffersByCategoryAndDescription(Category $category, string $description)
    {
        $repository = new OfferRepository(
            $this->pdo
        );

        return $repository->findActiveOffersByCategoryAndDescription(
            $category,
            $description
        );
    }

}