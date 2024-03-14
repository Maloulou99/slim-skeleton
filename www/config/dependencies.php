<?php

use DI\Container;
use PatrykZak\SlimSkeleton\Controller\FlashController;
use PatrykZak\SlimSkeleton\Controller\HomeController;
use PatrykZak\SlimSkeleton\model\Repository\MySqlUserRepository;
use PatrykZak\SlimSkeleton\model\UserRepository;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Flash\Messages;
use Student\SlimSkeleton\Controller\CreateUserController;
use Student\SlimSkeleton\Model\Repository\PDOSingleton;

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
$container->set(
    CreateUserController::class,
    function (Container $c) {
        $controller = new CreateUserController($c->get("view"), $c->get(UserRepository::class));
        return $controller;
    }
);
$container->set('db', function () {
    return PDOSingleton::getInstance(
        $_ENV['MYSQL_USER'],
        $_ENV['MYSQL_PASSWORD'],
        $_ENV['MYSQL_HOST'],
        $_ENV['MYSQL_PORT'],
        $_ENV['MYSQL_DATABASE']
    );
});

$container->set(UserRepository::class, function (ContainerInterface $container) {
    return new MySQLUserRepository($container->get('db'));
});
