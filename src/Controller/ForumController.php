<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     *  @Route("/forum/{slug}", name="forum")
     */
    public function displayForum(string $slug,PostRepository $postRepository): Response
    {

        $post = $postRepository->findOneBy([
            'slug' => $slug
        ]);

        if(!$post)
        {
            $this->addFlash('warning','La catégorie n\'existe pas');
            return $this->redirectToRoute('public_home');
        }

        $category = $post->getCategory();
        $postAssociate = [];

        if($category)
        {
            $postAssociate = $postRepository->findPost($category);
        }
        return $this->render('forum.html.twig',[
            'post' => $post,
            'postAssociate' => $postAssociate
        ]);
    }
}