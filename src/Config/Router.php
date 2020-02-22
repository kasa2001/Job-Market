<?php


namespace App\Config;


use App\Controller\Admin;
use App\Controller\Category;
use App\Controller\Home;
use App\Controller\Offer;
use App\Controller\Skill;
use App\Controller\User;
use App\Model\View\AdminModel;
use App\Model\View\EmptyModel;
use App\Model\View\OfferView;
use App\Model\View\SkillModel;
use App\Model\View\UserView;
use App\Service\CategoryService;
use App\Service\DatabaseService;
use App\Service\OfferService;
use App\Service\RoleService;
use App\Service\SessionService;
use App\Service\SkillService;
use App\Service\UserService;
use App\Service\ViewService;
use BlackFramework\Routing\Factory\DefaultFactory;
use BlackFramework\Routing\Parser\WebParser;
use BlackFramework\Routing\Router\DefaultRouter;

class Router
{
    private $routeArray = [
        //Controller constructor params
        'controller-params' => [
            Home::class => [
                ViewService::class,
                EmptyModel::class,
            ],
            User::class => [
                ViewService::class,
                UserService::class,
                DatabaseService::class,
                SessionService::class,
                RoleService::class,
                UserView::class,
            ],
            Admin::class => [
                ViewService::class,
                UserService::class,
                DatabaseService::class,
                RoleService::class,
                SessionService::class,
                OfferService::class,
                AdminModel::class,
            ],
            Offer::class => [
                ViewService::class,
                OfferService::class,
                DatabaseService::class,
                SessionService::class,
                UserService::class,
                RoleService::class,
                CategoryService::class,
                SkillService::class,
                OfferView::class,
            ],
            Category::class => [
                ViewService::class,
                CategoryService::class,
                DatabaseService::class,
                OfferService::class,
                OfferView::class,
            ],
            Skill::class => [
                SkillService::class,
                DatabaseService::class,
                ViewService::class,
                SkillModel::class,
            ]
        ],
        //Route definition
        'route-definition' => [
            //method
            'GET' => [
                //route pattern
                '^login$' => [
                    'controller' => User::class,
                    'action' => 'login',
                ], #
                '^registry$' => [
                    'controller' => User::class,
                    'action' => 'registry',
                ], #
                '^logout$' => [
                    'controller' => User::class,
                    'action' => 'logout',
                ], #
                '^addOffer$' => [
                    'controller' => Offer::class,
                    'action' => 'offerAdd'
                ], #
                '^listOffer$' => [
                    'controller' => Offer::class,
                    'action' => 'offerList'
                ], #
                '^offerDetails/\d+$' => [
                    'controller' => Offer::class,
                    'action' => 'showOffer',
                ], #
                '^profile/\d+$' => [
                    'controller' => User::class,
                    'action' => 'showProfile',
                ], #
                '^userLists$' => [
                    'controller' => Admin::class,
                    'action' => 'listUsers'
                ], #
                '^category/list/.+$' => [
                    'controller' => Category::class,
                    'action' => 'showList',
                ],
                '^skillList$' => [
                    'controller' => Skill::class,
                    'action' => 'showSkills'
                ],
                '^addSkill$' => [
                    'controller' => Skill::class,
                    'action' => 'addSkill',
                ],
            ],
            'POST' => [
                '^login$' => [
                    'controller' => User::class,
                    'action' => 'loginAction',
                    'query' => [
                        'login',
                        'password',
                    ],
                ], #
                '^registry$' => [
                    'controller' => User::class,
                    'action' => 'registryAction',
                    'query' => [
                        'login',
                        'password',
                        'first_name',
                        'last_name',
                    ],
                ], #
                '^addOffer$' => [
                    'controller' => Offer::class,
                    'action' => 'offerAddAction',
                    'query' => [
                        'description',
                        'category_id',
                    ],
                ], #
                '^addUserRole$' => [
                    'controller' => Admin::class,
                    'action' => 'connectWithRole',
                    'query' => [
                        'role_name',
                        'user_id'
                    ]
                ],
                '^addSkill$' => [
                    'controller' => Skill::class,
                    'action' => 'addSkillAction',
                    'query' => [
                        'name'
                    ],
                ],
            ],
            'PUT' => [
                '^offer/activation/\d+$' => [
                    'controller' => Admin::class,
                    'action' => 'activate',
                ], #
            ],
            'DELETE' => [
                '^removeUser/\d+$' => [
                    'controller' => Admin::class,
                    'action' => 'deleteUser',
                ], #
            ],
        ],
        'default-route' => [
            'controller' => Home::class,
            'action' => 'index',
            'parameters' => [],
        ]
    ];

    public function getRouteArray()
    {
        return $this->routeArray;
    }

    public function getRouterClassName()
    {
        return DefaultRouter::class;
    }

    public function getControllerFactoryName()
    {
        return DefaultFactory::class;
    }

    public function getParserName()
    {
        return WebParser::class;
    }
}