<?php

declare(strict_types=1);

namespace AppBundle\Controller\Home;

use AppBundle\Entity\Post;
use AppBundle\Repository\PostRepository;
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
        /** @var PostRepository $postRepository */
        $postRepository = $this->getDoctrine()->getManager()->getRepository(Post::class);

        $paginator = $this->get("knp_paginator");
        $pagination = $paginator->paginate(
            $postRepository->getLoaderQuery(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render("homepage/homepage.html.twig", array(
            "posts" => $pagination
        ));
    }

    /**
     * @Route("/about", name="_about")
     */
    public function showAboutPageAction(Request $request): Response
    {
        return new Response("Hello world!");
    }
}
