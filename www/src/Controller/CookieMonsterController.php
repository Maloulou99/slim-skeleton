<?php

namespace PatrykZak\SlimSkeleton\Controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CookieMonsterController
{
    private Twig $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function showAdvice(Request $request, Response $response): Response
    {
        $cookie = FigRequestCookies::get($request, 'cookies_advice', "0");

        $isAdvised = boolval($cookie->getValue());

        if (!$isAdvised) {
            $response = FigResponseCookies::set(
                $response,
                $this->generateAdviceCookie()
            );
        }

        return $this->twig->render($response, 'cookies.twig', [
            'isAdvised' => $isAdvised,
        ]);
    }

    private function generateAdviceCookie(): SetCookie
    {
        return SetCookie::create('cookies_advice')
            ->withValue("1")
            ->withDomain('localhost')
            ->withPath('/cookies');
    }
}