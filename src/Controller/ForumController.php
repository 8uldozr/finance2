<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     *  @Route("/forum", name="forum")
     */
    public function displayForum(PostRepository $postRepository, CommentRepository $commentRepository): Response
    {
        $post = $postRepository->findAll();

        $comments = $commentRepository->findBy([
            'post'=> $post
        ]);

        return $this->render("public/forum.html.twig",[
            'posts' => $post,
            'comments' => $comments
        ]);
    }
}