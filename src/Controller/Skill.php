<?php


namespace App\Controller;


use App\Model\IModel;
use App\Service\DatabaseService;
use App\Service\SkillService;
use App\Service\ViewService;
use BlackFramework\Routing\Container\WebContainer;

class Skill
{

    /**
     * @var SkillService
     */
    private $skillService;

    /**
     * @var ViewService
     */
    private $viewService;

    /**
     * @var IModel
     */
    private $model;



    public function __construct(
        SkillService $skillService,
        DatabaseService $databaseService,
        ViewService $viewService,
        IModel $model
    )
    {
        $this->skillService = $skillService;
        $this->skillService->setDatabaseService($databaseService);
        $this->viewService = $viewService;
        $this->model = $model;

    }


    public function addSkill()
    {
        $this->model->title = "Dodaj umiejętność";
        $this->model->view = "Skill/add";
        return $this->viewService->renderView($this->model);
    }

    public function addSkillAction(WebContainer $container)
    {
        $query = $container->getQuery();

        $skill = new \App\Model\Entity\Skill();
        $skill->name = $query->getElement('name');

        if ($this->skillService->saveSkill($skill)) {
            return "redirect://skillList";
        }
        //?
        return $this->addSkill();
    }

    public function showSkills()
    {
        $this->model->list = $this->skillService->getSkills();
        $this->model->title = "Lista umiejętności";
        $this->model->view = "Skill/list";

        return $this->viewService->renderView(
            $this->model
        );
    }
}