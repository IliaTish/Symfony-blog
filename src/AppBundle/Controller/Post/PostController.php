<?php

declare(strict_types=1);

namespace AppBundle\Controller\Post;

use AppBundle\Entity\Post;
use AppBundle\Form\PostCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($this->getUser());
            $post->setDateCreation(new \DateTime());

            $file = $form->get("image")->getData();

            $fileName = md5(uniqid()).".".$file->guessExtension();

            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $post->setImage($fileName);

            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();
        }


        return $this->render("post/post_creation.html.twig", array("form" => $form->createView()));
    }

    /**
     * @Route("/post/{id}", name="_post")
     */
    public function showPostAction(Request $request, string $id): Response
    {
        $postRepository = $this->getDoctrine()->getManager()->getRepository(Post::class);
        $post = $postRepository->findOneBy(array("id" => (int)$id));
        if (!$post) {
           throw new NotFoundHttpException("Post with this id not found!");
        }

        return $this->render("post/post.html.twig", array("post" => $post));
    }
}
