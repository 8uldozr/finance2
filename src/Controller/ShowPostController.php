<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 

class ShowPostController extends AbstractController
{
    /**
     * @Route("/analyse/{id}", name="public_show_post")
     */
    public function home(int $id, Request $request, PostRepository $postRepository, CommentRepository $commentRepository, EntityManagerInterface $em): Response

        {
            $post = $postRepository->find($id);

            $comment = $commentRepository->findBy([
                'post'=> $post
            ]);

            $form = $this->createForm(CommentType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())

            {
                /** @var Post $post */
                $comment = $form->getData();

                $comment->setPost($post);

                $em->persist($comment);

                $em->flush();

                $this->addFlash('success','Le commentaire a bien été créé.');

                return $this->redirectToRoute('public_show_post',['id' => $id]);
            }

            return $this->render("public/show_post.html.twig", [
                'post' => $post,
                'comment' => $comment,
                'form' => $form->createView() 
            ]);
        }
}