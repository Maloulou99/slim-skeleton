<?php

namespace PatrykZak\SlimSkeleton\Middleware;

use http\Env\Request;
use http\Env\Response;
use Slim\Handlers\Strategies\RequestHandler;

class SessionMiddleware
{
    public function __invoke(Request $request, RequestHandler $next): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $response = $next->handle($request);
        session_write_close();
        return $response;
    }
}