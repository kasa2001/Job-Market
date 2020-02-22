<?php


namespace App\Repository;

use App\Model\Entity\Role;
use App\Model\Entity\User;
use PDO;

class UserRepository
{
    /**
     * @var string
     */
    private $table = "sys.user";

    /**
     * @var string
     */
    private $connection = "sys.role_user";

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findUserByLoginAndPassword(User $user)
    {
        $statement = $this->pdo->prepare("select id, login, first_name, last_name from {$this->table} where login = :login and password = :password");
        $statement->execute(
            [
                "login" => $user->login,
                "password" => $user->password
            ]
        );

        return $statement->fetchObject(
            User::class
        );
    }

    public function findUserById(int $id)
    {
        $statement = $this->pdo->prepare("select id, login, first_name, last_name from {$this->table} where id = :id");
        $statement->execute(
            [
                "id" => $id
            ]
        );

        return $statement->fetchObject(User::class);
    }

    public function registerUser(User $user)
    {
        $statement = $this->pdo->prepare("insert into {$this->table} (login, password, first_name, last_name) values (:login, :password, :first_name, :last_name)");
        return $statement->execute(
            [
                "login" => $user->login,
                "password" => $user->password,
                "first_name" => $user->firstName,
                "last_name" => $user->lastName
            ]
        );
    }

    public function addRoleToUser(User $user, Role $role)
    {
        $statement = $this->pdo->prepare("insert into {$this->connection} (role_id, user_id) values (:role_id, :user_id)");
        return $statement->execute(
            [
                "role_id" => $role->id,
                "user_id" => $user->id
            ]
        );
    }

    public function userExists(User $user)
    {
        $statement = $this->pdo->prepare("select id from {$this->table} where login = :login");
        $statement->execute(
            [
                "login" => $user->login,
            ]
        );

        return count($statement->fetchAll());
    }

    public function findAll()
    {
        $statement = $this->pdo->prepare("select id, login, first_name, last_name from {$this->table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function hasRole(User $user, Role $role)
    {
        $statement = $this->pdo->prepare("select * from {$this->connection} where role_id = :role_id and user_id = :user_id");

        $statement->execute(
            [
                "role_id" => $role->id,
                "user_id" => $user->id,
            ]
        );

        return count($statement->fetchAll());
    }

    public function deleteUser(int $id)
    {
        $statement = $this->pdo->prepare("delete from {$this->table} where id = :id");

        return $statement->execute(
            [
                'id' => $id
            ]
        );
    }
}