<?php


namespace App\Service;


use App\Model\Entity\Offer;
use App\Model\Entity\Skill;

class SkillService
{

    /**
     * @var DatabaseService
     */
    private $databaseService;

    public function getSkills()
    {
        return $this->databaseService->getAllSkills();
    }

    /**
     * @param DatabaseService $databaseService
     */
    public function setDatabaseService(DatabaseService $databaseService): void
    {
        $this->databaseService = $databaseService;
    }

    public function getSkillFromOffer(Offer $offer)
    {
        return $this->databaseService->getSkillsFromOffer($offer);
    }

    public function saveSkill(Skill $skill)
    {
        return $this->databaseService->saveSkill($skill);
    }


}