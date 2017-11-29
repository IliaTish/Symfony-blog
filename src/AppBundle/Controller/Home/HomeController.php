<?php

declare(strict_types=1);

namespace AppBundle\Controller\Home;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="_homepage")
     */
    public function showHomePageAction(Request $request): Response
    {
        return $this->render("homepage/homepage.html.twig");
    }

    /**
     * @Route("/about", name="_about")
     */
    public function showAboutPageAction(Request $request): Response{
        return new Response("Hello world!");
    }
}
