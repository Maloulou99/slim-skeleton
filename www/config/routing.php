<?php
declare(strict_types=1);

use PatrykZak\SlimSkeleton\Controller\HomeController;
use PatrykZak\SlimSkeleton\Controller\VisitsController;
use PatrykZak\SlimSkeleton\Middleware\AfterMiddleware;
use PatrykZak\SlimSkeleton\Middleware\SessionMiddleware;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Student\SlimSkeleton\Controller\CreateUserController;

$app->get('/', HomeController::class . ':apply')->setName('home')->add(AfterMiddleware::class);

$app->get('/', function (Request $request, Response $response) {
    // $response->getBody()->write("<h1>Hello World!</h1>");
    // return $response;
    return $this->get("view")->render($response, "home.twig", ["username" => "Patryk"]);
})->setName("home");

$app->get('/', HomeController::class . ':apply')->setName('home');

$app->add(AfterMiddleware::class);

$app->add(SessionMiddleware::class);
$app->get('/visits', VisitsController::class . ':showVisits')->setName('visits');
$app->post('/user', CreateUserController::class . ":apply")->setName('create_user');



