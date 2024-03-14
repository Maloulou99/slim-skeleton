<?php

use DI\Container;
use PatrykZak\SlimSkeleton\Controller\FlashController;
use PatrykZak\SlimSkeleton\Controller\HomeController;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Flash\Messages;

$container = new Container();

$container->set("view", function () {
    return Twig::create(__DIR__ ."/../templates", ["cache" => false]);
});

$container->set(Twig::class, function (ContainerInterface $c) {
    return $c->get('view');
});

/*$container->set(HomeController::class, function (ContainerInterface $c) {
    return new HomeController($c->get('view'));
});*/

$container->set(
    HomeController::class,
    function (ContainerInterface $c) {
        $controller = new HomeController($c->get("view"), $c->get("flash"));
        return $controller;
    }
);
$container->set(Messages::class, function () {
    return new Messages();
});

$container->set('flash',  function () {
    return new Messages();
});

$container->set(
    FlashController::class,
    function (Container $c) {
        return new FlashController($c->get("view"), $c->get("flash"));
    }
);

