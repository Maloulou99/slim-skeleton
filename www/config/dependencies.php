<?php

use DI\Container;
use Slim\Views\Twig;

$container = new Container();

$container->set("view", function () {
    return Twig::create(__DIR__ ."/../templates", ["cache" => false]);
});

$container->set(Twig::class, function (ContainerInterface $c) {
    return $c->get('view');
});