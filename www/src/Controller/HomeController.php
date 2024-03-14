<?php

declare(strict_types=1);

namespace PatrykZak\SlimSkeleton\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Flash\Messages;
use Slim\Views\Twig;

class HomeController
{
    private Twig $twig;
    private Messages $flash;

    public function __construct(Twig $twig, Messages $flash){
        $twig->twig = $twig;
        $flash->flash = $flash;
    }

//framweork will run this function in a controller to return what?
    public function apply(Request $request, Response $response): Response
    {
        $messages = $this->flash->getMessages();

        $notifications = $messages['notifications'] ?? [];

        return $this->twig->render($response, 'home.twig', [
            'notifications' => $notifications
        ]);
    }
}