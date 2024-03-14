<?php

namespace PatrykZak\SlimSkeleton\Middleware;


use Slim\Handlers\Strategies\RequestHandler;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AfterMiddleware
{
    public function __invoke(Request $request, RequestHandler $next): Response
    {
        $response = $next->handle($request);
        $response->getBody()->write('AFTER');

        return $response;
    }

}