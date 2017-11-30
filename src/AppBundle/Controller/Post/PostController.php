<?php

declare(strict_types=1);

namespace AppBundle\Controller\Post;

use AppBundle\Entity\Post;
use AppBundle\Form\PostCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends Controller
{
    /**
     * @Route("/post", name="_post_create")
     */
    public function showPostCreationAction(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostCreationType::class, $post);

        $form->handleRequest($request);

        echo($form->isValid());

        if($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($this->getUser());
            $post->setDateCreation(new \DateTime());

            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render("post/post_creation.html.twig", array("form" => $form->createView()));
    }
}
