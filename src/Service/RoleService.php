<?php


namespace App\Service;


use App\Model\Entity\Role;
use BlackFramework\Routing\Exception\NotFound;

class RoleService
{

    /**
     * @var DatabaseService
     */
    private $databaseService;

    /**
     * @param string $roleName
     * @return Role
     * @throws NotFound
     */
    public function getRole(string $roleName): Role
    {
        return $this->databaseService->getRole(
            $roleName
        );
    }

    /**
     * @param DatabaseService $databaseService
     */
    public function setDatabaseService(DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }
}