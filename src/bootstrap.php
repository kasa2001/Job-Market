<?php

define("APPLICATION_PATH", dirname(__DIR__));

use App\Config\Router;
use App\Config\Session;

use BlackFramework\Core\AutoLoader;
use BlackFramework\Routing\Exception\RouterException;

include '../vendor/blackframework/core/src/AutoLoader.php';

$array = include '../vendor/composer/autoload_psr4.php';

$autoloader = new AutoLoader();

foreach ($array as $key => &$value) {
    $autoloader->registerNamespace(
        $key,
        $value
    );
}

$session = new Session();

if ($session->isEnable()) {
    session_start();
}

$routeArray = new Router();

$routerName = $routeArray->getRouterClassName();
$routerParser = $routeArray->getParserName();
$routerFactory = $routeArray->getControllerFactoryName();

$router = new $routerName (
    new $routerParser(),
    new $routerFactory()
);

try {
    $router->configure(
        $routeArray->getRouteArray()
    );

    $route = $router->choose();

    $html = $router->execute(
        $route['controller'],
        $route['action'],
        $route['parameters']
    );

    if (preg_match("/^redirect:\/(.+)/", $html, $match)) {
        $router->redirect($match[1]);
    }

    if (preg_match("/^nocontent:\//", $html)) {
        header("HTTP/2.0 204 NO CONTENT");
        return null;
    }
    return $html;
} catch (RouterException $exception) {
    return $router->executeException($exception->getCode(), APPLICATION_PATH);
}