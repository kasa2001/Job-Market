<?php


namespace App\Repository;

use App\Model\Entity\Offer;
use App\Model\Entity\Skill;
use PDO;

class SkillRepository
{

    /**
     * @var PDO
     */
    private $pdo;

    private $table = 'skill';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $statement = $this->pdo->prepare("select id, name from {$this->table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Skill::class);
    }

    public function getSelectedSkills(Offer $offer)
    {
        $statement = $this->pdo->prepare("select main.id as id, main.name as name from {$this->table} as main inner join offer_skill os on os.skill_id = main.id and os.offer_id = :offer_id");
        $statement->execute(
            [
                'offer_id' =>$offer->id
            ]
        );

        return $statement->fetchAll(PDO::FETCH_CLASS, Skill::class);
    }

    public function save(Skill $skill)
    {
        $statement = $this->pdo->prepare("insert into {$this->table} (name) values (:name)");

        return $statement->execute(
            [
                'name' => $skill->name
            ]
        );
    }
}