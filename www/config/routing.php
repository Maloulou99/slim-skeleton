<?php
declare(strict_types=1);

use Slim\Psr7\Request;
use Slim\Psr7\Response;


$app->get('/', function (Request $request, Response $response) {
    // $response->getBody()->write("<h1>Hello World!</h1>");
    // return $response;
    return $this->get("view")->render($response, "home.twig", ["username" => "Patryk"]);
})->setName("home");