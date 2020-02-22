<?php


namespace App\Repository;

use App\Model\Entity\Role;
use PDO;

class RoleRepository
{

    /**
     * @var string
     */
    private $table = 'sys.role';

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findRoleByName(string $roleName)
    {
        $statement = $this->pdo->prepare("select id, role_name from {$this->table} where role_name = :role_name");

        $statement->execute(
            [
                "role_name" => $roleName
            ]
        );

        return $statement->fetchObject(Role::class);
    }
}