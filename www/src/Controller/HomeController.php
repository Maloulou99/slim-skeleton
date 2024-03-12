//HomeController
<?php

//namespcae??

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response


final class HomeController
{
    private Twig $twig;

    public funtion __construct(Twig $twig){
        $this->twig = $twig;
    }

    //framweork will run this function in a controller to return what? 
    public function apply(Request $request, Response $response ) : response
    {
        return $this->twig->render($response, 'home.twig', ['username' => 'Pol']);
    }
}